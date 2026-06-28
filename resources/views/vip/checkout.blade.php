@extends('layouts.app')

@section('content')
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  .pay-page {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #eef2f9;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 16px;
  }

  .pay-card {
    display: grid;
    grid-template-columns: 380px 1fr;
    max-width: 980px;
    width: 100%;
    background: #fff;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 24px 80px rgba(24,194,156,.13);
  }

  .pay-left {
    background: linear-gradient(155deg, #0e9e7e 0%, #13b090 55%, #18c29c 100%);
    padding: 44px 36px;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #fff;
    position: relative;
    overflow: hidden;
  }

  .pay-left::before {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    background: rgba(255,255,255,.06);
    border-radius: 50%;
    top: -80px; right: -80px;
  }

  .pay-left::after {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    background: rgba(255,255,255,.06);
    border-radius: 50%;
    bottom: -50px; left: -50px;
  }

  .pay-bank-badge {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 50px;
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .4px;
    margin-bottom: 24px;
  }

  .pay-bank-badge .pay-dot {
    width: 8px; height: 8px;
    background: #4ade80;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 3px rgba(74,222,128,.3);
  }

  .pay-left h2 { font-size: 26px; font-weight: 800; text-align: center; }
  .pay-left p  { font-size: 14px; opacity: .8; margin-top: 6px; text-align: center; }

  .pay-qr-wrap {
    background: #fff;
    border-radius: 22px;
    padding: 16px;
    margin-top: 28px;
    width: 100%;
    position: relative;
    z-index: 1;
    box-shadow: 0 8px 32px rgba(0,0,0,.15);
  }

  .pay-qr-wrap img { width: 100%; display: block; border-radius: 12px; }

  .pay-qr-label {
    margin-top: 14px;
    text-align: center;
    font-size: 12px;
    opacity: .7;
    line-height: 1.6;
  }

  .pay-timer {
    margin-top: 20px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 12px;
    padding: 12px 20px;
    font-size: 13px;
    text-align: center;
    position: relative;
    z-index: 1;
    width: 100%;
  }

  .pay-timer strong { font-size: 22px; display: block; font-weight: 700; margin-top: 2px; }

  .pay-right { padding: 44px 40px; display: flex; flex-direction: column; }

  .pay-right-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 28px;
  }

  .pay-right-header h1 { font-size: 24px; font-weight: 800; color: #0f172a; }
  .pay-right-header p  { font-size: 13px; color: #94a3b8; margin-top: 4px; }

  .pay-order-badge {
    background: rgba(24,194,156,.08);
    color: #18c29c;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 50px;
    border: 1px solid rgba(24,194,156,.25);
    white-space: nowrap;
  }

  .pay-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 22px;
  }

  .pay-info-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 14px 16px;
  }

  .pay-info-item .pay-lbl {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: #94a3b8;
    margin-bottom: 5px;
  }

  .pay-info-item .pay-val { font-size: 15px; font-weight: 700; color: #0f172a; }

  .pay-amount-box {
    background: rgba(24,194,156,.06);
    border: 1.5px solid rgba(24,194,156,.25);
    border-radius: 16px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 22px;
  }

  .pay-amount-box .pay-lbl { font-size: 13px; color: #64748b; font-weight: 500; }
  .pay-amount-box .pay-amount { font-size: 28px; font-weight: 900; color: #18c29c; }
  .pay-amount-box .pay-amount span { font-size: 16px; font-weight: 600; margin-left: 2px; }

  .pay-content-box {
    background: #f8fafc;
    border: 1.5px dashed rgba(24,194,156,.35);
    border-radius: 16px;
    padding: 18px 20px;
    margin-bottom: 22px;
  }

  .pay-content-box .pay-lbl {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: #94a3b8;
    margin-bottom: 8px;
  }

  .pay-content-row { display: flex; align-items: center; gap: 12px; }

  .pay-content-val {
    font-size: 18px;
    font-weight: 800;
    color: #18c29c;
    flex: 1;
    word-break: break-all;
  }

  .pay-copy-btn {
    border: none;
    background: #18c29c;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transition: background .2s, transform .1s;
  }

  .pay-copy-btn:hover  { background: #0e9e7e; }
  .pay-copy-btn:active { transform: scale(.97); }

  .pay-status-box {
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 18px;
    transition: all .4s;
  }

  .pay-status-pending { background: #fff7ed; border: 1.5px solid #fed7aa; color: #c2410c; }
  .pay-status-success { background: #f0fdf4; border: 1.5px solid #86efac; color: #16a34a; }

  .pay-status-icon {
    width: 36px; height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 16px;
  }

  .pay-status-pending .pay-status-icon { background: #fed7aa; }
  .pay-status-success .pay-status-icon { background: #bbf7d0; }

  .pay-spinner {
    width: 16px; height: 16px;
    border: 2.5px solid #c2410c;
    border-top-color: transparent;
    border-radius: 50%;
    animation: pay-spin .8s linear infinite;
    display: inline-block;
  }

  @keyframes pay-spin { to { transform: rotate(360deg); } }

  .pay-note {
    font-size: 13px;
    color: #64748b;
    line-height: 1.7;
    display: flex;
    gap: 8px;
  }

  .pay-note::before { content: '💡'; flex-shrink: 0; margin-top: 1px; }

  @media (max-width: 820px) {
    .pay-card          { grid-template-columns: 1fr; }
    .pay-left          { padding: 36px 28px; }
    .pay-right         { padding: 32px 24px; }
    .pay-info-grid     { grid-template-columns: 1fr; }
  }
</style>

<div class="pay-page">
<div class="pay-card">

  {{-- LEFT: QR Panel --}}
  <div class="pay-left">
    <div class="pay-bank-badge">
      <span class="pay-dot"></span> {{ $order->bank_name }}
    </div>
    <h2>Quét mã QR</h2>
    <p>Thanh toán bằng App ngân hàng</p>

    <div class="pay-qr-wrap">
      <img src="{{ $payment['qr_url'] }}" alt="QR thanh toán">
    </div>

    <div class="pay-qr-label">
      Mở App ngân hàng → Chọn Quét mã QR<br>→ Hướng camera vào mã trên
    </div>

    <div class="pay-timer">
      Hiệu lực còn lại
      <strong id="pay-countdown">14:59</strong>
    </div>
  </div>

  {{-- RIGHT: Order Info --}}
  <div class="pay-right">
    <div class="pay-right-header">
      <div>
        <h1>Thanh toán đơn hàng</h1>
        <p>Vui lòng hoàn tất trước khi hết giờ</p>
      </div>
      <div class="pay-order-badge">#{{ $order->order_code }}</div>
    </div>

    <div class="pay-info-grid">
      <div class="pay-info-item">
        <div class="pay-lbl">Ngân hàng</div>
        <div class="pay-val">{{ $payment['bank_name'] }}</div>
      </div>
      <div class="pay-info-item">
        <div class="pay-lbl">Số tài khoản</div>
        <div class="pay-val">{{ $payment['account_number'] }}</div>
      </div>
      <div class="pay-info-item" style="grid-column:1/-1">
        <div class="pay-lbl">Chủ tài khoản</div>
        <div class="pay-val">{{ $payment['account_name'] }}</div>
      </div>
    </div>

    <div class="pay-amount-box">
      <div class="pay-lbl">Số tiền cần chuyển</div>
      <div class="pay-amount">{{ number_format($order->final_amount) }}<span>đ</span></div>
    </div>

    <div class="pay-content-box">
      <div class="pay-lbl">Nội dung chuyển khoản</div>
      <div class="pay-content-row">
        <div class="pay-content-val" id="pay-transfer">{{ $payment['content'] }}</div>
        <button class="pay-copy-btn" onclick="payCopyTransfer()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <rect x="9" y="9" width="13" height="13" rx="2"/>
            <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
          </svg>
          Sao chép
        </button>
      </div>
    </div>

    <div id="pay-status" class="pay-status-box pay-status-pending">
      <div class="pay-status-icon"><div class="pay-spinner"></div></div>
      <div>
        <div>Đang chờ thanh toán</div>
        <div style="font-size:12px;font-weight:400;margin-top:2px;opacity:.8">
          Hệ thống sẽ tự động xác nhận sau khi nhận tiền
        </div>
      </div>
    </div>

    <div class="pay-note">
      Sau khi chuyển khoản thành công, hệ thống sẽ tự động kích hoạt VIP trong vài giây.
      Đảm bảo nội dung chuyển khoản chính xác để được xử lý nhanh nhất.
    </div>
  </div>

</div>
</div>

<script>
function payCopyTransfer() {
  const text = document.getElementById('pay-transfer').innerText.trim();
  navigator.clipboard.writeText(text).then(() => {
    const btn = document.querySelector('.pay-copy-btn');
    btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Đã sao chép`;
    btn.style.background = '#16a34a';
    setTimeout(() => {
      btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Sao chép`;
      btn.style.background = '';
    }, 2000);
  });
}

// Đếm ngược 15 phút
let paySecs = 14 * 60 + 59;
const payCd = document.getElementById('pay-countdown');
const payTimer = setInterval(() => {
  if (paySecs <= 0) { payCd.textContent = '00:00'; clearInterval(payTimer); return; }
  paySecs--;
  payCd.textContent = String(Math.floor(paySecs / 60)).padStart(2, '0')
    + ':' + String(paySecs % 60).padStart(2, '0');
}, 1000);

// Poll thanh toán mỗi 3 giây
setInterval(function () {
  fetch("{{ route('vip.check-payment', $order) }}")
    .then(r => r.json())
    .then(function (data) {
      if (data.status === 'paid') {
        const box = document.getElementById('pay-status');
        box.className = 'pay-status-box pay-status-success';
        box.innerHTML = `
          <div class="pay-status-icon">✔</div>
          <div>
            <div>Thanh toán thành công!</div>
            <div style="font-size:12px;font-weight:400;margin-top:2px">
              Đang kích hoạt VIP và chuyển hướng...
            </div>
          </div>`;
        clearInterval(payTimer);
        setTimeout(() => window.location = '/', 2000);
      }
    });
}, 3000);
</script>

@endsection