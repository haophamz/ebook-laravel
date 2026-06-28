@extends('layouts.app')

@section('content')
<style>
  /* ===== RESET & BASE ===== */
  .pkg-page {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: linear-gradient(135deg, #e8f0fe 0%, #dbeafe 50%, #ede9fe 100%);
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 100px 20px 60px;
    box-sizing: border-box;
  }
  .pkg-page * { box-sizing: border-box; }
  .pkg-container { max-width: 1100px; width: 100%; }

  /* ===== VIP ACTIVE BANNER ===== */
  .vip-banner {
    position: relative;
    background: #18c29c;
    border-radius: 20px;
    padding: 0;
    margin-bottom: 40px;
    box-shadow: 0 16px 40px rgba(15,23,42,0.18);
    overflow: hidden;
    isolation: isolate;
  }

  /* subtle gold accent line on top */
  .vip-banner::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #fbbf24, #f59e0b 50%, #fbbf24);
    z-index: 2;
  }

  /* faint diagonal sheen */
  .vip-banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(255,255,255,0.05) 0%, transparent 40%);
    pointer-events: none;
    z-index: 0;
  }

  .vip-banner-inner {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    padding: 22px 28px;
  }

  .vip-banner-body { flex: 1 1 auto; min-width: 0; }

  .vip-banner-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #fbbf24;
    margin-bottom: 8px;
  }

  .vip-active-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #4ade80;
    box-shadow: 0 0 0 3px rgba(74,222,128,0.25);
    animation: pulse-dot 2s infinite;
    flex-shrink: 0;
  }
  @keyframes pulse-dot {
    0%, 100% { box-shadow: 0 0 0 3px rgba(74,222,128,0.25); }
    50%       { box-shadow: 0 0 0 6px rgba(74,222,128,0.08); }
  }

  .vip-banner-title {
    font-size: 19px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 6px;
    letter-spacing: -0.2px;
  }

  .vip-banner-sub {
    font-size: 13.5px;
    color: rgba(255,255,255,0.55);
    margin: 0;
    line-height: 1.5;
  }
  .vip-banner-sub strong { color: rgba(255,255,255,0.85); font-weight: 600; }

  .vip-banner-expires {
    text-align: right;
    flex-shrink: 0;
    padding-left: 24px;
    border-left: 1px solid rgba(255,255,255,0.12);
  }
  .vip-banner-expires .exp-label {
    font-size: 10.5px;
    color: rgba(255,255,255,0.45);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 5px;
  }
  .vip-banner-expires .exp-date {
    font-size: 19px;
    font-weight: 800;
    color: #fbbf24;
    white-space: nowrap;
    letter-spacing: -0.3px;
  }

  @media (max-width: 640px) {
    .vip-banner-inner { flex-direction: column; align-items: flex-start; gap: 14px; }
    .vip-banner-expires {
      text-align: left;
      padding-left: 0;
      border-left: none;
      border-top: 1px solid rgba(255,255,255,0.12);
      padding-top: 14px;
      width: 100%;
    }
  }

  /* ===== HEADER ===== */
  .pkg-header { text-align: center; margin-bottom: 48px; }
  .pkg-header h1 {
    font-size: 40px;
    font-weight: 800;
    color: #111827;
    letter-spacing: -1.5px;
    margin-bottom: 8px;
  }
  .pkg-subtitle { font-size: 16px; color: #6b7280; margin: 0; }

  /* ===== CARDS ===== */
  .pkg-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
    align-items: stretch;
    margin-bottom: 40px;
  }

  .pkg-card {
    background: white;
    border-radius: 24px;
    padding: 36px 28px 32px;
    border: 2px solid transparent;
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
  }
  .pkg-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px rgba(24,194,156,0.18);
    border-color: #18c29c;
  }
  .pkg-card.pkg-popular {
    background: linear-gradient(160deg, #1d4ed8 0%, #2563eb 40%, #3b82f6 100%);
    transform: scale(1.04);
    box-shadow: 0 24px 64px rgba(37,99,235,0.35);
  }
  .pkg-card.pkg-popular:hover {
    transform: scale(1.04) translateY(-6px);
    box-shadow: 0 32px 72px rgba(37,99,235,0.4);
  }

  .pkg-popular-badge {
    position: absolute;
    top: -16px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(90deg, #f59e0b, #f97316);
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 20px;
    border-radius: 20px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(249,115,22,0.4);
  }

  .pkg-duration {
    text-align: center;
    font-size: 20px;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
  }
  .pkg-card.pkg-popular .pkg-duration { color: white; }

  .pkg-tagline {
    text-align: center;
    font-size: 13px;
    color: #9ca3af;
    margin-bottom: 20px;
    font-weight: 500;
    min-height: 18px;
  }
  .pkg-card.pkg-popular .pkg-tagline { color: rgba(255,255,255,0.65); }

  .pkg-price {
    text-align: center;
    font-size: 40px;
    font-weight: 900;
    color: #18c29c;
    letter-spacing: -1px;
    margin-bottom: 8px;
  }
  .pkg-card.pkg-popular .pkg-price { color: white; }

  .pkg-per-month {
    display: block;
    text-align: center;
    margin-bottom: 14px;
  }
  .pkg-per-month span {
    display: inline-block;
    background: rgba(24,194,156,0.08);
    color: #18c29c;
    font-size: 13px;
    font-weight: 600;
    padding: 5px 14px;
    border-radius: 30px;
    border: 1px solid rgba(24,194,156,0.2);
  }
  .pkg-card.pkg-popular .pkg-per-month span {
    background: rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.9);
    border: none;
  }

  .pkg-savings {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #fef3c7;
    color: #92400e;
    font-size: 12.5px;
    font-weight: 700;
    padding: 8px 16px;
    border-radius: 12px;
    margin-bottom: 14px;
  }
  .pkg-savings svg {
    width: 14px;
    height: 14px;
    stroke: #92400e;
    fill: none;
    flex-shrink: 0;
  }
  .pkg-savings.pkg-hidden { visibility: hidden; }
  .pkg-card.pkg-popular .pkg-savings { background: rgba(255,255,255,0.18); color: white; }
  .pkg-card.pkg-popular .pkg-savings svg { stroke: white; }

  .pkg-divider { height: 1px; background: #f3f4f6; margin: 20px 0; }
  .pkg-card.pkg-popular .pkg-divider { background: rgba(255,255,255,0.15); }

  .pkg-features {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 13px;
    flex: 1;
    margin-bottom: 28px;
    padding: 0;
  }
  .pkg-features li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #374151;
    font-weight: 500;
  }
  .pkg-card.pkg-popular .pkg-features li { color: rgba(255,255,255,0.9); }

  .pkg-check {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(24,194,156,0.12);
    border: 1px solid rgba(24,194,156,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .pkg-check svg {
    width: 11px;
    height: 11px;
    stroke: #18c29c;
    fill: none;
  }
  .pkg-card.pkg-popular .pkg-check { background: rgba(255,255,255,0.25); border: none; }
  .pkg-card.pkg-popular .pkg-check svg { stroke: white; }

  .pkg-cta-btn {
    width: 100%;
    padding: 16px;
    border-radius: 16px;
    border: none;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    letter-spacing: 0.3px;
  }
  .pkg-cta-btn.pkg-outline {
    background: rgba(24,194,156,0.08);
    color: #18c29c;
    border: 2px solid rgba(24,194,156,0.3);
  }
  .pkg-cta-btn.pkg-outline:hover {
    background: #18c29c;
    color: white;
    border-color: #18c29c;
    box-shadow: 0 8px 20px rgba(24,194,156,0.35);
  }
  .pkg-cta-btn.pkg-solid { background: white; color: #1d4ed8; }
  .pkg-cta-btn.pkg-solid:hover {
    background: #f0f4ff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }

  /* ===== FOOTER ===== */
  .pkg-footer { text-align: center; }
  .pkg-secure-note {
    font-size: 13px;
    color: #9ca3af;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .pkg-secure-note svg {
    width: 14px;
    height: 14px;
    stroke: #9ca3af;
    fill: none;
  }
  .pkg-payment-methods {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
  }
  .pkg-pm-chip {
    background: white;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  }

  .pkg-empty {
    text-align: center;
    color: #6b7280;
    font-size: 15px;
    padding: 40px 0;
  }

  @media (max-width: 900px) {
    .pkg-cards { grid-template-columns: 1fr; }
    .pkg-card.pkg-popular { transform: none; }
    .pkg-card.pkg-popular:hover { transform: translateY(-6px); }
  }
</style>

<div class="pkg-page">
  <div class="pkg-container">

    {{-- ===== VIP ACTIVE BANNER ===== --}}
    @auth
      @if(auth()->user()->isVip())
        <div class="vip-banner">
          <div class="vip-banner-inner">

            <div class="vip-banner-body">
              <div class="vip-banner-eyebrow">
                <span class="vip-active-dot"></span>
                Hội viên VIP
              </div>
              <div class="vip-banner-title">Tài khoản của bạn đang được kích hoạt VIP</div>
              <p class="vip-banner-sub">
                Khi gia hạn thêm, thời hạn mới sẽ <strong>cộng dồn</strong> vào ngày hết hạn hiện tại — không bị mất thời gian còn lại.
              </p>
            </div>

            <div class="vip-banner-expires">
              <div class="exp-label">Hết hạn lúc</div>
              <div class="exp-date">{{ auth()->user()->vip_expires_at->format('d/m/Y') }}</div>
            </div>

          </div>
        </div>
      @endif
    @endauth

    {{-- ===== PAGE HEADER ===== --}}
    <div class="pkg-header">
      <h1>Đăng ký gói</h1>
      <p class="pkg-subtitle">Chọn gói phù hợp với nhu cầu của bạn</p>
    </div>

    @if($plans->isEmpty())
      <div class="pkg-empty">
        Hiện chưa có gói VIP nào khả dụng. Vui lòng quay lại sau.
      </div>
    @else

      @php
        $cheapestPerMonth = $plans->min(fn ($p) => $p->months > 0 ? $p->price / $p->months : $p->price);
      @endphp

      <div class="pkg-cards">
        @foreach($plans as $plan)
          @php
            $perMonth = $plan->months > 0 ? $plan->price / $plan->months : $plan->price;
            $savingPercent = $cheapestPerMonth > 0
                ? round((1 - ($perMonth / $cheapestPerMonth)) * 100)
                : 0;
            $isPopular = (bool) $plan->is_popular;
          @endphp

          <div class="pkg-card @if($isPopular) pkg-popular @endif">

            @if($isPopular)
              <div class="pkg-popular-badge">Phổ biến nhất</div>
            @endif

            <div class="pkg-duration">{{ $plan->months }} THÁNG</div>

            <div class="pkg-tagline">{{ $plan->name }}</div>

            <div class="pkg-price">{{ number_format($plan->price, 0, ',', '.') }}đ</div>

            <div class="pkg-per-month">
              <span>{{ number_format($perMonth, 0, ',', '.') }}đ / tháng</span>
            </div>

            <div class="pkg-savings @if($savingPercent <= 0) pkg-hidden @endif">
              <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41L11 3.83A2 2 0 0 0 9.59 3.24H4a1 1 0 0 0-1 1v5.59a2 2 0 0 0 .59 1.41l9.58 9.58a2 2 0 0 0 2.83 0l4.59-4.59a2 2 0 0 0 0-2.83z"/>
                <circle cx="7.5" cy="7.5" r="1.2" fill="currentColor" stroke="none"/>
              </svg>
              Tiết kiệm {{ $savingPercent }}%
            </div>

            <div class="pkg-divider"></div>

            <ul class="pkg-features">
              @if($plan->description)
                @foreach(preg_split('/\r\n|\r|\n/', trim($plan->description)) as $line)
                  @if(trim($line) !== '')
                    <li>
                      <span class="pkg-check">
                        <svg viewBox="0 0 24 24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                          <polyline points="20 6 9 17 4 12"/>
                        </svg>
                      </span>
                      {{ trim($line) }}
                    </li>
                  @endif
                @endforeach
              @else
                <li>
                  <span class="pkg-check">
                    <svg viewBox="0 0 24 24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </span>
                  Đọc không giới hạn toàn bộ thư viện ebook
                </li>
                <li>
                  <span class="pkg-check">
                    <svg viewBox="0 0 24 24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </span>
                  Cập nhật sách mới liên tục hàng tuần
                </li>
                <li>
                  <span class="pkg-check">
                    <svg viewBox="0 0 24 24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </span>
                  Hỗ trợ khách hàng ưu tiên
                </li>
                <li>
                  <span class="pkg-check">
                    <svg viewBox="0 0 24 24" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </span>
                  Hủy gói bất kỳ lúc nào, không phí ẩn
                </li>
              @endif
            </ul>

            <form action="{{ route('vip.subscribe') }}" method="POST">
              @csrf
              <input type="hidden" name="plan_id" value="{{ $plan->id }}">
              <button type="submit"
                      class="pkg-cta-btn {{ $isPopular ? 'pkg-solid' : 'pkg-outline' }}">
                @if(auth()->check() && auth()->user()->isVip())
                  Gia hạn thêm {{ $plan->months }} tháng
                @else
                  Đăng ký gói {{ $plan->months }} tháng
                @endif
              </button>
            </form>

          </div>
        @endforeach
      </div>

    @endif

    <div class="pkg-footer">
      <div class="pkg-secure-note">
        <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="5" y="11" width="14" height="9" rx="2"/>
          <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
        </svg>
        Thanh toán an toàn và bảo mật
      </div>
      <div class="pkg-payment-methods">
        <div class="pkg-pm-chip">
          <img src="https://simg.zalopay.com.vn/zlp-website/assets/new_logo_6c5db2d21b.svg"
               alt="ZaloPay" height="22" style="object-fit:contain;">
        </div>
        <div class="pkg-pm-chip">
          <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg"
               alt="MoMo" height="22" style="object-fit:contain;">
        </div>
        <div class="pkg-pm-chip">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpAu2kw1DdvmskCrDj6xxJJs_yTqAXoAamjdCzRGHQnA&s=10"
               alt="Visa" height="20" style="object-fit:contain;">
        </div>
        <div class="pkg-pm-chip">
          <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
               alt="Mastercard" height="22" style="object-fit:contain;">
        </div>
        <div class="pkg-pm-chip">
          <img src="https://static.vecteezy.com/system/resources/thumbnails/013/948/616/small/bank-icon-logo-design-vector.jpg"
               alt="Banking" height="22" style="object-fit:contain;">
        </div>
      </div>
    </div>

  </div>
</div>
@endsection