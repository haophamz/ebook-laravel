
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/jszip/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        main {
            padding-top: 0 !important;
        }
        body {
            font-family: 'Georgia', serif;
            background: #1a1a1a;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .reader-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 52px;
            background: #111;
            border-bottom: 1px solid #2e2e2e;
            flex-shrink: 0;
        }

        .reader-header h1 {
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 0.06em;
            color: #aaa;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 60%;
        }

        .header-back {
            font-size: 13px;
            color: #666;
            text-decoration: none;
            transition: color 0.2s;
        }
        .header-back:hover { color: #ccc; }

        .reader-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        #viewer {
            width: 720px;
            max-width: 100%;
            height: 100%;
            background: #fdf8f0;
            box-shadow: 0 0 60px rgba(0,0,0,0.6);
            position: relative;
        }

        .reader-status {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #fdf8f0;
            color: #888;
            font-size: 14px;
            font-family: Georgia, serif;
            z-index: 5;
        }
        .spinner {
            width: 28px;
            height: 28px;
            border: 2px solid #ddd;
            border-top-color: #888;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .reader-status.error { color: #c0504d; }
        .reader-status.error .spinner { display: none; }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50%;
            color: #aaa;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
            z-index: 10;
            user-select: none;
        }
        .nav-btn:hover { background: rgba(255,255,255,0.14); color: #fff; }
        .nav-btn:active { background: rgba(255,255,255,0.22); }
        #prev-btn { left: 16px; }
        #next-btn { right: 16px; }

        .reader-footer {
            height: 36px;
            background: #111;
            border-top: 1px solid #2e2e2e;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        #page-info {
            font-size: 12px;
            color: #555;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>

<header class="reader-header">
    <a href="{{ url()->previous() }}" class="header-back">← Quay lại</a>
    <h1>{{ $book->title }}</h1>
    <div></div>
</header>

<div class="reader-body">
    <button class="nav-btn" id="prev-btn">&#8249;</button>

    <div id="viewer">
        <div class="reader-status" id="status">
            <div class="spinner"></div>
            <span>Đang tải sách…</span>
        </div>
    </div>

    <button class="nav-btn" id="next-btn">&#8250;</button>
</div>

<footer class="reader-footer">
    <span id="page-info">—</span>
</footer>

<script>
(function () {
    const url        = "{{ asset('storage/' . $book->epub_file) }}";
    const statusEl   = document.getElementById('status');
    const pageInfoEl = document.getElementById('page-info');

    function showError(msg) {
        statusEl.classList.add('error');
        const spinner = statusEl.querySelector('.spinner');
        if (spinner) spinner.style.display = 'none';
        statusEl.querySelector('span').textContent = msg;
    }

    // Tải sách dưới dạng ArrayBuffer để tránh lỗi CORS hoặc MIME type trên một số trình duyệt
    fetch(url)
        .then(r => {
            if (!r.ok) throw new Error('HTTP ' + r.status);
            return r.arrayBuffer();
        })
        .then(buffer => {
            const book      = ePub(buffer);
            const rendition = book.renderTo('viewer', {
                width : '100%',
                height: '100%',
                spread: 'none',
                flow  : 'paginated',
            });

            const lastPosition = @json($position);
            rendition.display(lastPosition || undefined)
                .then(() => {
                    if (statusEl) statusEl.remove();
                    
                    // SỬA LỖI: Ép thư viện tính toán toàn bộ vị trí các trang ảo trong sách (Locations)
                    // Nếu không có bước này, epub.js sẽ không thể tính tỷ lệ % chính xác và trả về số 0.
                    return book.locations.generate(1024);
                })
                .then(() => {
                    // Sau khi tính toán vị trí xong, cập nhật giao diện hiển thị % của trang hiện tại luôn
                    const currentLocation = rendition.currentLocation();
                    if (currentLocation && currentLocation.start) {
                        updateProgressUI(currentLocation);
                    }
                })
                .catch(err => {
                    console.error(err);
                    showError('Không render được: ' + err.message);
                });

            // Hàm tính toán và cập nhật giao diện hiển thị số phần trăm (%)
            function updateProgressUI(location) {
                if (!location || !location.start) return;
                
                // Sử dụng mã định danh CFI đối chiếu vào danh sách locations đã tạo để tính % chính xác nhất
                const progressFraction = book.locations.percentageFromCfi(location.start.cfi);
                const pct = Math.round(progressFraction * 100);
                
                pageInfoEl.textContent = isNaN(pct) || pct < 0 ? "—" : pct + "%";
            }

            // 1. Điều hướng bằng các nút nhấn trên giao diện chính
            document.getElementById('prev-btn').addEventListener('click', () => rendition.prev());
            document.getElementById('next-btn').addEventListener('click', () => rendition.next());

            // 2. Lắng nghe phím mũi tên khi tiêu điểm nằm ngoài tài liệu sách
            document.addEventListener('keydown', e => {
                if (e.key === 'ArrowLeft')  rendition.prev();
                if (e.key === 'ArrowRight') rendition.next();
            });

            // 3. Đăng ký hook vào nội dung của iframe (Xử lý sự kiện bàn phím và vuốt chạm khi đang click trong trang sách)
            rendition.hooks.content.register(function(contents) {
                // Sự kiện phím bấm trong iframe sách
                contents.document.addEventListener('keydown', e => {
                    if (e.key === 'ArrowLeft')  rendition.prev();
                    if (e.key === 'ArrowRight') rendition.next();
                });

                // Sự kiện vuốt chạm mobile trên màn hình đọc
                let touchStartX = 0;
                contents.document.addEventListener('touchstart', e => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                contents.document.addEventListener('touchend', e => {
                    const diff = touchStartX - e.changedTouches[0].screenX;
                    if (Math.abs(diff) > 40) {
                        diff > 0 ? rendition.next() : rendition.prev();
                    }
                }, { passive: true });
            });

            // 4. Lắng nghe sự kiện chuyển trang (Relocated) để tính toán tiến độ và gửi API (Debounce)
            let saveTimer;
            rendition.on("relocated", function(location) {
                
                // Cập nhật % trực quan hiển thị dưới thanh footer ngay lập tức khi qua trang
                updateProgressUI(location);

                clearTimeout(saveTimer);
                saveTimer = setTimeout(function() {
                    // Đối chiếu CFI của trang hiện tại sang tỉ lệ % số thập phân thực tế
                    const progressFraction = book.locations.percentageFromCfi(location.start.cfi);
                    let finalPercent = Math.round(progressFraction * 100);
                    
                    // Ràng buộc giới hạn dữ liệu chống lỗi NaN hoặc số âm ngoài ý muốn
                    if (isNaN(finalPercent) || finalPercent < 0) finalPercent = 0;
                    if (finalPercent > 100) finalPercent = 100;

                    // Gửi request cập nhật tiến độ vào database của Laravel backend
                    fetch("{{ route('reading.progress') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            book_id: {{ $book->id }},
                            progress: finalPercent, // Số nguyên từ 0 -> 100 chuẩn xác
                            cfi: location.start.cfi
                        })
                    }).catch(err => console.error('Lỗi lưu tiến độ:', err));
                }, 1000); // Đợi 1 giây sau khi dừng chuyển trang mới gửi để tránh spam request liên tục
            });
        })
        .catch(err => {
            console.error(err);
            showError('Không thể tải file sách: ' + err.message);
        });
})();
</script>

</body>
</html>
