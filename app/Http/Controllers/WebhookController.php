<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\SepayService;
use App\Services\VipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookPurchase;
use App\Models\Cart;
class WebhookController extends Controller
{
    public function sepay(
        Request $request,
        SepayService $sepay,
        VipService $vip
    ) {
        // Kiểm tra chữ ký HMAC bảo mật từ SePay
        if (!$sepay->verify($request)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid signature'
            ], 401);
        }

        $data = $request->all();

        // Chỉ nhận giao dịch tiền vào (giao dịch cộng tiền ngân hàng)
        if (($data['transferType'] ?? '') !== 'in') {
            return response()->json([
                'success' => true
            ]);
        }

        DB::transaction(function () use ($data, $sepay, $vip) {

            // 1. Tìm đơn hàng đại diện dựa vào nội dung chuyển khoản
            $representativeOrder = $sepay->findOrder($data);

            if (!$representativeOrder) {
                return;
            }

            // Đã thanh toán rồi thì hệ thống bỏ qua để tránh trùng lặp
            if ($representativeOrder->status === 'paid') {
                return;
            }

            // 🌟 2. LẤY TOÀN BỘ CÁC ĐƠN HÀNG TRONG LƯỢT THANH TOÁN NÀY
            // Nếu đơn hàng đại diện có mã nhóm giỏ hàng, tìm theo cart_group_code. Ngược lại tìm theo chính nó.
            if ($representativeOrder->cart_group_code) {
                $orderGroup = Order::where('cart_group_code', $representativeOrder->cart_group_code)
                                   ->where('status', 'pending')
                                   ->get();
            } else {
                // Trường hợp mua lẻ trực tiếp bên ngoài không qua giỏ hàng
                $orderGroup = Order::where('id', $representativeOrder->id)
                                   ->where('status', 'pending')
                                   ->get();
            }

            if ($orderGroup->isEmpty()) {
                return;
            }

            // Tính tổng số tiền thực tế của cả nhóm đơn hàng này (đã trừ coupon nếu có)
            $totalGroupFinalAmount = $orderGroup->sum('final_amount');

            // 3. KIỂM TRA SỐ TIỀN KHỚP VỚI GIAO DỊCH NGÂN HÀNG
            // Tạo một bản clone giả lập tổng tiền để hàm validAmount của SDK chạy chính xác
            $mockOrder = clone $representativeOrder;
            $mockOrder->final_amount = $totalGroupFinalAmount;

            if (!$sepay->validAmount($mockOrder, $data)) {
                return;
            }

            // Tránh lưu trùng transaction từ ngân hàng bắn sang
            if (
                Transaction::where(
                    'transaction_code',
                    $data['referenceCode'] ?? null
                )->exists()
            ) {
                return;
            }

            // 4. LƯU LẠI LỊCH SỬ GIAO DỊCH (Gắn vào ID đơn hàng đại diện)
            Transaction::create([
                'order_id' => $representativeOrder->id,
                'gateway' => 'sepay',
                'transaction_code' => $data['referenceCode'] ?? null,
                'gateway_order_id' => $data['id'] ?? null,
                'amount' => $data['transferAmount'] ?? 0,
                'status' => 'success',
                'response' => $data,
                'paid_at' => now(),
            ]);

            // 5. VÒNG LẶP KÍCH HOẠT HÀNG LOẠT TOÀN BỘ SẢN PHẨM TRONG ĐƠN HÀNG
            foreach ($orderGroup as $order) {
                
                // Cập nhật trạng thái Paid cho từng dòng đơn hàng lẻ
                $order->update([
                    'status' => 'paid',
                    'payment_method' => 'bank',
                    'paid_at' => now(),
                ]);

                // Tăng số lượng sử dụng nếu đơn hàng có áp mã coupon
                if ($order->coupon) {
                    $order->coupon->increment('used_count');
                }

                // TRƯỜNG HỢP A: ĐƠN HÀNG MUA GÓI VIP
                if ($order->vip_plan_id) {
                    $vip->activate(
                        $order->user,
                        $order->vipPlan->months
                    );
                }

                // TRƯỜNG HỢP B: ĐƠN HÀNG MUA SÁCH (Mỗi dòng là 1 book_id chuẩn số)
                if ($order->book_id && is_numeric($order->book_id)) {
                    BookPurchase::firstOrCreate(
                        [
                            'user_id' => $order->user_id,
                            'book_id' => (int) $order->book_id,
                        ],
                        [
                            'order_id' => $order->id,
                            'price' => $order->final_amount, // Lưu đúng số tiền thực trả sau giảm giá của cuốn này
                            'purchased_at' => now(),
                        ]
                    );
                }
            }
            $purchasedBookIds = $orderGroup->pluck('book_id')->filter()->toArray();
            if (!empty($purchasedBookIds)) {
               Cart::where('user_id', $representativeOrder->user_id)
                                ->whereIn('book_id', $purchasedBookIds)
                                ->delete();
            }
        });

        return response()->json([
            'success' => true
        ]);
    }
}
