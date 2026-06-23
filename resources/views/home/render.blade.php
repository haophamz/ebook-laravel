<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/jszip/dist/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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

<script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>
<script>
(function () {
    const url        = "{{ asset('storage/' . $book->epub_file) }}";
    const statusEl   = document.getElementById('status');
    const pageInfoEl = document.getElementById('page-info');

    function showError(msg) {
        statusEl.classList.add('error');
        statusEl.querySelector('.spinner').style.display = 'none';
        statusEl.querySelector('span').textContent = msg;
    }

    // Fetch dưới dạng ArrayBuffer để bypass lỗi MIME type null
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

            rendition.display().then(() => {
                statusEl.remove();
            }).catch(err => {
                console.error(err);
                showError('Không render được: ' + err.message);
            });

            // Nút điều hướng
            document.getElementById('prev-btn').addEventListener('click', () => rendition.prev());
            document.getElementById('next-btn').addEventListener('click', () => rendition.next());

            // Phím mũi tên
            document.addEventListener('keydown', e => {
                if (e.key === 'ArrowLeft')  rendition.prev();
                if (e.key === 'ArrowRight') rendition.next();
            });

            // Vuốt mobile
            let touchStartX = 0;
            document.getElementById('viewer').addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            document.getElementById('viewer').addEventListener('touchend', e => {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 40) {
                    diff > 0 ? rendition.next() : rendition.prev();
                }
            }, { passive: true });

            // % tiến độ
            rendition.on('relocated', location => {
                try {
                    const pct = Math.round(location.start.percentage * 100);
                    pageInfoEl.textContent = isNaN(pct) ? '—' : pct + '%';
                } catch (_) {}
            });
        })
        .catch(err => {
            console.error(err);
            showError('Không tải được file: ' + err.message);
        });
})();
</script>

</body>
</html>