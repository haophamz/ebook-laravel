
@extends('account.layout')

@section('account-content')

<h1 class="page-title">
    Giỏ hàng của tôi
</h1>

{{-- CHỈ GIỮ LẠI 1 FORM DUY NHẤT: Ép link URL tĩnh độc lập để không bao giờ bị đè trùng route validate lẻ --}}
<form action="/cart/process-checkout" method="POST" id="cart-form">
    @csrf

    <div class="cart-container">
        <div class="bookshelf-grid">
        @forelse($items as $item)
            @php
                $book = $item->book;
            @endphp

            {{-- Kiểm tra phòng vệ: Nếu bản ghi sách bị xóa, không hiển thị ra để tránh lỗi giao diện --}}
            @if($book)
                <div class="book-item-wrapper" data-price="{{ $item->price }}" id="cart-item-{{ $item->id }}">
                    
                    <div class="cart-checkbox-wrapper">
                        <label class="checkbox-container">
                            <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" class="cart-item-checkbox" checked>
                            <span class="checkmark"></span>
                            <span class="checkbox-text">Chọn mua</span>
                        </label>
                    </div>

                    <a href="{{ route('home.watch', $book->slug) }}" class="book-item">
                        <div class="book-cover">
                            @if($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}" alt="{{ $book->title }}">
                            @else
                                <div class="no-cover"><i class="ti ti-book"></i></div>
                            @endif
                        </div>

                        <div class="book-info">
                            <h3>{{ $book->title }}</h3>
                            <div class="book-price">
                                {{ number_format($item->price) }}đ
                            </div>
                        </div>
                    </a>

                    <button type="button" class="btn-remove-item" onclick="deleteCartItem('{{ $item->id }}')" title="Xóa khỏi giỏ hàng">
                        <i class="ti ti-trash"></i> Xóa khỏi giỏ
                    </button>
                </div>
            @endif
        @empty
            <div class="empty-box">
                <i class="ti ti-shopping-cart-off"></i>
                <h3>Giỏ hàng trống</h3>
                <p>Bạn chưa thêm cuốn sách tính phí nào vào giỏ hàng.</p>
                <a href="/" class="btn-back-home">Khám phá sách ngay</a>
            </div>
        @endforelse
        </div>

        @if($items->count())
            <div class="cart-summary-card">
                <div class="summary-header">
                    <h3>Thông tin đơn hàng</h3>
                </div>
                <div class="summary-body">
                    <div class="summary-row">
                        <span>Đã chọn:</span>
                        <strong id="selected-count">{{ $items->count() }} cuốn</strong>
                    </div>
                    <div class="summary-row total-row">
                        <span>Tổng tiền:</span>
                        <span class="total-price" id="selected-total">{{ number_format($total) }}đ</span>
                    </div>
                    
                    {{-- ĐÃ XÓA THẺ FORM LỒNG SAI CÚ PHÁP TẠI ĐÂY --}}
                    <button type="submit" class="btn-checkout-all" id="btn-submit-checkout">
                        <i class="ti ti-credit-card"></i> Tiến hành thanh toán
                    </button>
                    
                    <p class="checkout-note">
                        <i class="ti ti-shield-check"></i> Thanh toán an toàn, bảo mật qua QR SePay.
                    </p>
                </div>
            </div>
        @endif
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.cart-item-checkbox');
    const totalElement = document.getElementById('selected-total');
    const countElement = document.getElementById('selected-count');
    const submitBtn = document.getElementById('btn-submit-checkout');

    function calculateCart() {
        let total = 0;
        let count = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const wrapper = cb.closest('.book-item-wrapper');
                if (wrapper) {
                    const price = parseFloat(wrapper.getAttribute('data-price')) || 0;
                    total += price;
                    count++;
                }
            }
        });

        // Cập nhật hiển thị số lượng và tổng số tiền thanh toán
        if (totalElement) {
            totalElement.textContent = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        }
        if (countElement) {
            countElement.textContent = count + ' cuốn';
        }
        
        // Khóa nút nếu không tích chọn cuốn nào
        if (submitBtn) {
            if (count === 0) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.4';
                submitBtn.style.cursor = 'not-allowed';
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }
    }

    // Theo dõi sự kiện click thay đổi của các checkbox
    checkboxes.forEach(cb => {
        cb.addEventListener('change', calculateCart);
    });

    calculateCart();
});

// Hàm gọi submit xóa item giỏ hàng độc lập (Bọc ngoài form chính chống lỗi lồng nhau)
function deleteCartItem(itemId) {
    if (confirm('Bạn có chắc chắn muốn xóa cuốn sách này khỏi giỏ hàng không?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/cart/${itemId}`;
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<style>
.page-title {
    color: #fff;
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 30px;
}

.cart-container {
    display: flex;
    align-items: flex-start;
    gap: 30px;
}

.bookshelf-grid {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.book-item-wrapper {
    display: flex;
    flex-direction: column;
    background: #1e1e24;
    border-radius: 16px;
    padding: 14px;
    transition: transform .25s, box-shadow .25s;
    border: 1px solid rgba(255, 255, 255, 0.03);
}

.book-item-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.4);
}

.book-item {
    text-decoration: none;
    display: block;
}

.book-cover {
    height: 250px;
    border-radius: 12px;
    overflow: hidden;
    background: #141416;
}

.book-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s;
}

.book-item:hover .book-cover img {
    transform: scale(1.04);
}

.no-cover {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #555;
    font-size: 40px;
}

.book-info {
    margin-top: 12px;
}

.book-info h3 {
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 6px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    height: 42px;
}

.book-price {
    color: #18c29c;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 4px;
}

.cart-checkbox-wrapper {
    margin-bottom: 12px;
}

.checkbox-container {
    display: flex;
    align-items: center;
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    font-size: 13px;
    color: #8b8b95;
    user-select: none;
    font-weight: 600;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: rgba(255, 255, 255, 0.08);
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: 0.2s;
}

.checkbox-container:hover input ~ .checkmark {
    background-color: rgba(255, 255, 255, 0.15);
}

.checkbox-container input:checked ~ .checkmark {
    background-color: #18c29c;
    border-color: #18c29c;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-container .checkmark:after {
    left: 6px;
    top: 2px;
    width: 4px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox-container input:checked ~ .checkbox-text {
    color: #18c29c;
}

.btn-remove-item {
    width: 100%;
    background: rgba(239, 68, 68, 0.08);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.15);
    padding: 8px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 14px;
    transition: 0.2s;
}

.btn-remove-item:hover {
    background: #ef4444;
    color: #fff;
}

.cart-summary-card {
    width: 320px;
    background: #1e1e24;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 22px;
    position: sticky;
    top: 20px;
}

.summary-header h3 {
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    color: #8b8b95;
    font-size: 14px;
    margin-bottom: 14px;
}

.summary-row strong {
    color: #fff;
}

.total-row {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px dashed rgba(255, 255, 255, 0.1);
    align-items: center;
}

.total-row span {
    font-size: 16px;
    color: #fff;
    font-weight: 600;
}

.total-price {
    color: #18c29c !important;
    font-size: 26px !important;
    font-weight: 800;
}

.btn-checkout-all {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: #18c29c;
    color: #fff;
    border: none;
    padding: 14px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    margin-top: 20px;
    transition: all 0.2s;
    box-shadow: 0 4px 15px rgba(24, 194, 156, 0.25);
}

.btn-checkout-all:hover:not(:disabled) {
    background: #14a383;
    transform: translateY(-2px);
}

.checkout-note {
    font-size: 12px;
    color: #8b8b95;
    text-align: center;
    margin-top: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.empty-box {
    grid-column: 1/-1;
    text-align: center;
    padding: 80px 0;
}

.empty-box i {
    font-size: 80px;
    color: #3a3a44;
    margin-bottom: 16px;
}

.empty-box h3 {
    color: #fff;
    font-size: 22px;
    margin-bottom: 8px;
}

.empty-box p {
    color: #8b8b95;
    margin-bottom: 24px;
}

.btn-back-home {
    display: inline-block;
    background: #18c29c;
    color: #fff;
    text-decoration: none;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.2s;
}

.btn-back-home:hover {
    background: #14a383;
}

@media(max-width: 1200px) {
    .cart-container {
        flex-direction: column;
    }
    .cart-summary-card {
        width: 100%;
        position: static;
        order: -1;
        margin-bottom: 10px;
    }
    .bookshelf-grid {
        grid-template-columns: repeat(4, 1fr);
        width: 100%;
    }
}

@media(max-width: 950px) {
    .bookshelf-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 650px) {
    .bookshelf-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .book-cover {
        height: 200px;
    }
}
</style>

@endsection

