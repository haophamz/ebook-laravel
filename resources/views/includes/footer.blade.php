
<footer class="footer">

    <div class="footer-container">

        <div class="footer-grid">

            <div>
                <div class="footer-logo">ECOBOOK</div>

                <p class="footer-desc">
                    Nền tảng đọc Ebook hiện đại với hàng nghìn đầu sách miễn phí,
                    sách mua lẻ và sách dành cho hội viên VIP.
                </p>

                <div class="footer-social">
                    <a href="#"><i class="ti ti-brand-facebook"></i></a>
                    <a href="#"><i class="ti ti-brand-youtube"></i></a>
                    <a href="#"><i class="ti ti-brand-github"></i></a>
                    <a href="#"><i class="ti ti-mail"></i></a>
                </div>
            </div>

            <div>
                <h3>Khám phá</h3>

                <ul>
                    <li><a href="{{ route('books.free') }}">Sách miễn phí</a></li>
                    <li><a href="{{ route('books.member') }}">Sách hội viên</a></li>
                    <li><a href="{{ route('books.paid') }}">Sách mua lẻ</a></li>
                    <li><a href="{{ route('pricing') }}">Gói thành viên</a></li>
                </ul>
            </div>

            <div>
                <h3>Liên hệ</h3>

                <ul class="contact-list">
                    <li><i class="ti ti-map-pin"></i> TP. Hồ Chí Minh, Việt Nam</li>
                    <li><i class="ti ti-phone"></i> 0123 456 789</li>
                    <li><i class="ti ti-mail"></i> support@ecobook.vn</li>
                    <li><i class="ti ti-clock"></i> 08:00 - 22:00</li>
                </ul>
            </div>

            <div>
                <h3>Bản đồ</h3>

                <div class="footer-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d823.7206927569812!2d106.61744081197433!3d10.864921342401157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b2a11844fb9%3A0xbed3d5f0a6d6e0fe!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBHaWFvIFRow7RuZyBW4bqtbiBU4bqjaSBUaMOgbmggUGjhu5EgSOG7kyBDaMOtIE1pbmggKFVUSCkgLSBDxqEgc-G7nyAz!5e0!3m2!1svi!2s!4v1782810726866!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} ECOBOOK. All Rights Reserved.
        </div>

    </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@if (!isset($__hasJquery))
    <script>
        if (typeof jQuery === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><\/script>');
        }
    </script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    if (window.toastr) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 4000,
        };
    }
</script>

<style>
    /* Nút tròn góc phải dưới */
    .support-fab {
        position: fixed; bottom: 28px; right: 28px; width: 60px; height: 60px; border-radius: 50%;
        background: linear-gradient(135deg, #2ecc71, #16a085); color: #fff; border: none; display: flex; align-items: center;
        justify-content: center; font-weight: 700; cursor: pointer; box-shadow: 0 8px 20px rgba(22,160,133,0.45);
        transition: transform .2s; z-index: 1000; font-family: 'Segoe UI', sans-serif;
    }
    .support-fab:hover { transform: translateY(-3px); }

    /* Overlay nền mờ */
    .overlay { position: fixed; inset: 0; background: rgba(10,12,15,0.5); display: none; align-items: center; justify-content: center; padding: 20px; z-index: 1001; }
    .overlay.active { display: flex; }

    .ticket-container {
        position: relative; max-width: 480px; width: 100%; max-height: 90vh; overflow: hidden;
        display: flex; flex-direction: column;
        background: rgba(34, 38, 44, 0.85);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px; box-shadow: 0 25px 60px rgba(0,0,0,0.55);
        animation: popIn .25s ease; font-family: 'Segoe UI', sans-serif; color: #e9ebef;
    }
    @keyframes popIn { from { opacity: 0; transform: scale(.95); } to { opacity: 1; transform: scale(1); } }

    .ticket-header {
        display: flex; align-items: center; gap: 12px;
        padding: 16px 20px;
        background: linear-gradient(120deg, #1fb678, #16a085);
        flex-shrink: 0;
    }
    .ticket-header .bot-icon {
        width: 34px; height: 34px; border-radius: 50%;
        background: rgba(255,255,255,0.18);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; font-weight: 700; color: #fff;
        flex-shrink: 0;
    }
    .ticket-header h2 { margin: 0; font-size: 16px; color: #fff; font-weight: 600; flex: 1; }
    .close-btn {
        width: 28px; height: 28px; border-radius: 50%; border: none;
        background: rgba(255,255,255,0.15); color: #fff; cursor: pointer;
        display: flex; align-items: center; justify-content: center; font-size: 13px;
        transition: background .15s;
    }
    .close-btn:hover { background: rgba(255,255,255,0.3); }

    .ticket-body { padding: 24px; overflow-y: auto; }

    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #b6bcc6; }
    .form-group label span { color: #ff6b6b; }

    .form-group input, .form-group textarea {
        width: 100%; padding: 12px 14px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; font-size: 14px;
        font-family: inherit; outline: none; transition: .15s; box-sizing: border-box;
        background: rgba(255,255,255,0.05); color: #f0f1f4;
    }
    .form-group input::placeholder, .form-group textarea::placeholder { color: #7a818c; }
    .form-group input:focus, .form-group textarea:focus { border-color: #2ecc71; box-shadow: 0 0 0 3px rgba(46,204,113,0.18); background: rgba(255,255,255,0.07); }

    .field-error { color: #ff6b6b; font-size: 12px; margin-top: 6px; }

    .dropdown-wrapper { position: relative; width: 100%; }
    .select-selected {
        padding: 12px 14px; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; cursor: pointer;
        display: flex; justify-content: space-between; align-items: center;
        background: rgba(255,255,255,0.05); font-size: 14px; color: #f0f1f4;
        transition: border-color .15s;
    }
    .select-selected:hover { border-color: rgba(255,255,255,0.25); }
    .select-selected:after { content: "▼"; font-size: 10px; color: #7a818c; }
    .select-items {
        display: none; position: absolute; width: 100%; z-index: 99;
        background: rgba(30, 34, 40, 0.97);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; margin-top: 6px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        overflow: hidden;
    }
    .select-items div { padding: 12px 14px; cursor: pointer; font-size: 14px; color: #d4d7dc; transition: background .12s; }
    .select-items div:hover, .select-items div.active { background: rgba(46,204,113,0.15); color: #2ecc71; }

    .upload-area {
        border: 1.5px dashed rgba(255,255,255,0.15); padding: 20px; text-align: center; border-radius: 10px;
        cursor: pointer; transition: .3s; background: rgba(255,255,255,0.03);
    }
    .upload-area:hover { border-color: #2ecc71; background: rgba(46,204,113,0.06); }
    .upload-area h3 { margin: 0 0 5px; font-size: 14px; color: #d4d7dc; font-weight: 600; }
    .upload-area p { margin: 0; font-size: 12px; color: #7a818c; }
    .upload-filename { margin-top: 8px; font-size: 12px; color: #2ecc71; }

    .btn-submit {
        width: 100%; padding: 14px; color: white; border: none; border-radius: 10px; font-weight: bold;
        font-size: 14px; cursor: pointer; transition: filter .2s, transform .1s;
        background: linear-gradient(120deg, #2ecc71, #16a085);
    }
    .btn-submit:hover { filter: brightness(1.08); }
    .btn-submit:active { transform: scale(.98); }

    .ticket-footer-note { text-align: center; font-size: 11.5px; color: #6b7178; margin: 14px 0 0; line-height: 1.5; }
</style>

<button class="support-fab" id="ticketOpenBtn">Hỗ trợ</button>

<div class="overlay" id="ticketOverlay" @if($errors->any()) style="display:flex" @endif>
    <div class="ticket-container">
        <div class="ticket-header">
            <div class="bot-icon">W</div>
            <h2>Gửi yêu cầu hỗ trợ</h2>
            <button type="button" class="close-btn" id="ticketCloseBtn">&times;</button>
        </div>

        <div class="ticket-body">

            <form method="POST" action="{{ route('support-ticket.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Email liên hệ <span>*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="ban@email.com">
                    @error('email') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Tiêu đề yêu cầu <span>*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Ví dụ: Đã thanh toán nhưng chưa nhận được VIP">
                    @error('title') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Danh mục hỗ trợ <span>*</span></label>
                    <div class="dropdown-wrapper">
                        <div class="select-selected" id="ticketSelectedItem">
                            {{ old('category') ? (\App\Models\SupportTicket::CATEGORIES[old('category')] ?? 'Chọn danh mục...') : 'Chọn danh mục...' }}
                        </div>
                        <div class="select-items" id="ticketSelectItems">
                            @php $ticketCategories = \App\Models\SupportTicket::CATEGORIES; @endphp
                            @foreach ($ticketCategories as $value => $label)
                                <div data-value="{{ $value }}" class="{{ old('category') === $value ? 'active' : '' }}">{{ $label }}</div>
                            @endforeach
                        </div>
                        <input type="hidden" name="category" id="ticketCategoryInput" value="{{ old('category') }}">
                    </div>
                    @error('category') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Mô tả chi tiết <span>*</span></label>
                    <textarea rows="4" name="description" placeholder="Mô tả vấn đề của bạn...">{{ old('description') }}</textarea>
                    @error('description') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Hình ảnh đính kèm</label>
                    <div class="upload-area" id="ticketUploadBox">
                        <h3>Chọn hoặc kéo thả ảnh</h3>
                        <p>JPG, PNG, WEBP (Tối đa 5MB)</p>
                        <input type="file" name="image" id="ticketFileInput" accept="image/jpeg,image/png,image/webp" style="display:none">
                        <div class="upload-filename" id="ticketFileName"></div>
                    </div>
                    @error('image') <div class="field-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-submit">Gửi yêu cầu</button>
                <p class="ticket-footer-note">Chúng tôi thường phản hồi trong vòng 24 giờ làm việc.</p>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    const openBtn = document.getElementById('ticketOpenBtn');
    const closeBtn = document.getElementById('ticketCloseBtn');
    const overlay = document.getElementById('ticketOverlay');
    openBtn.onclick = () => overlay.classList.add('active');
    closeBtn.onclick = () => overlay.classList.remove('active');
    overlay.onclick = (e) => { if (e.target === overlay) overlay.classList.remove('active'); };

    const selectedItem = document.getElementById("ticketSelectedItem");
    const selectItems = document.getElementById("ticketSelectItems");
    const categoryInput = document.getElementById("ticketCategoryInput");

    selectedItem.onclick = () => selectItems.style.display = (selectItems.style.display === "block") ? "none" : "block";

    selectItems.querySelectorAll("div").forEach(item => {
        item.onclick = () => {
            selectedItem.innerText = item.innerText;
            categoryInput.value = item.dataset.value;
            selectItems.style.display = "none";
        };
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown-wrapper')) selectItems.style.display = "none";
    });

    const uploadBox = document.getElementById('ticketUploadBox');
    const fileInput = document.getElementById('ticketFileInput');
    const fileName = document.getElementById('ticketFileName');
    uploadBox.onclick = () => fileInput.click();
    fileInput.addEventListener('change', () => {
        fileName.textContent = fileInput.files.length ? fileInput.files[0].name : '';
    });
})();

@if (session('ticket_success'))
    toastr.success("{{ session('ticket_success') }}");
@endif

@if ($errors->any())
    toastr.error("Vui lòng kiểm tra lại thông tin trong form.");
@endif
</script>
</footer>

<style>

.footer{
    margin-top:80px;
    background:#0f1412;
    border-top:2px solid #18c29c;
}

.footer-container{
    max-width:1400px;
    margin:auto;
    padding:60px 24px 25px;
}

.footer-grid{
    display:grid;
    grid-template-columns:2fr 1fr 1.3fr 2fr;
    gap:45px;
}

.footer-logo{
    font-size:34px;
    font-weight:800;
    color:#18c29c;
    margin-bottom:18px;
}

.footer-desc{
    color:#a5a5a5;
    line-height:1.8;
    margin-bottom:25px;
}

.footer h3{
    color:#fff;
    margin-bottom:20px;
    font-size:18px;
}

.footer ul{
    list-style:none;
    padding:0;
    margin:0;
}

.footer li{
    margin-bottom:14px;
    color:#bdbdbd;
}

.footer a{
    color:#bdbdbd;
    text-decoration:none;
    transition:.25s;
}

.footer a:hover{
    color:#18c29c;
}

.contact-list li{
    display:flex;
    gap:10px;
    align-items:center;
}

.contact-list i{
    color:#18c29c;
    font-size:18px;
}

.footer-social{
    display:flex;
    gap:12px;
}

.footer-social a{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#1a1f1d;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#18c29c;
    font-size:20px;
    transition:.25s;
}

.footer-social a:hover{
    background:#18c29c;
    color:#fff;
    transform:translateY(-3px);
}

.footer-map{
    border-radius:14px;
    overflow:hidden;
    border:2px solid #18c29c;
}

.footer-map iframe{
    width:100%;
    height:220px;
    border:0;
    display:block;
}

.footer-bottom{
    margin-top:45px;
    padding-top:22px;
    border-top:1px solid #2b2b2b;
    text-align:center;
    color:#8f8f8f;
    font-size:14px;
}

@media(max-width:1100px){

    .footer-grid{
        grid-template-columns:1fr 1fr;
    }

}

@media(max-width:768px){

    .footer-grid{
        grid-template-columns:1fr;
    }

}
</style>

