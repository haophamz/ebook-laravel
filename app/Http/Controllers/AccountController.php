<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBook;
use Illuminate\Support\Facades\Hash; 
class AccountController extends Controller
{   
public function favorites()
{   
    $books = UserBook::with('book')

        ->where('user_id', auth()->id())

        ->where('is_favorite', true)

        ->latest()

        ->paginate(24);

    return view(
        'account.favorites',
        compact('books')
    );
}
    public function profile()
    {
        return view('account.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
        ]);

           return back()->with('success', 'Cập nhật thông tin thành công');

    }
    public function history()
{
    $books = UserBook::with('book')

        ->where('user_id', auth()->id())

        ->whereNotNull('last_read_at')

        ->latest('last_read_at')

        ->paginate(24);

    return view(
        'account.history',
        compact('books')
    );
}
public function password()
{
    return view('account.password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed',
    ],[
        'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
        'password.required' => 'Vui lòng nhập mật khẩu mới',
        'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp',
    ]);

    if (!Hash::check(
        $request->current_password,
        auth()->user()->password
    )) {

        return back()->with(
            'error',
            'Mật khẩu hiện tại không đúng'
        );
    }

    auth()->user()->update([
        'password' => Hash::make(
            $request->password
        )
    ]);

    return back()->with(
        'success',
        'Đổi mật khẩu thành công'
    );
}
public function vip()
{
    return view('account.vip');
}
public function purchased()
{
    // Lấy tất cả đơn hàng gộp hoặc đơn lẻ đã paid của user
    $orders = \App\Models\Order::where('user_id', auth()->id())
        ->where('status', 'paid')
        ->get();

    $bookIds = [];
    foreach ($orders as $order) {
        if ($order->cart_group_code) {
            // Nếu dùng giỏ hàng gộp mới (mỗi cuốn 1 dòng order lẻ trong group)
            if ($order->book_id) $bookIds[] = $order->book_id;
        } elseif ($order->book_id && str_starts_with($order->book_id, 'cart_')) {
            // Phòng hờ chuỗi cũ "cart_1,2,3"
            $ids = explode(',', str_replace('cart_', '', $order->book_id));
            $bookIds = array_merge($bookIds, $ids);
        } elseif ($order->book_id) {
            // Mua lẻ đơn chiếc
            $bookIds[] = $order->book_id;
        }
    }

    // Lọc trùng và lấy danh sách sách
    $uniqueIds = array_unique(array_filter($bookIds));
    $purchasedBooks = \App\Models\Book::whereIn('id', $uniqueIds)->get();

    // Trả về view Sách đã mua riêng biệt
    return view('account.purchased', compact('purchasedBooks'));
}
}