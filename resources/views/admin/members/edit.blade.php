@extends('layouts.quanli')

{{-- Layout in @yield('styles') BÊN TRONG thẻ <style>, nên ở đây phải là CSS thuần,
     không phải <link> hay @import. --}}
@section('styles')

:root{
    --mb-accent-50:  #f0f9ff;
    --mb-accent-100: #e0f2fe;
    --mb-accent-200: #bae6fd;
    --mb-accent-500: #0ea5e9;
    --mb-accent-600: #0284c7;
    --mb-accent-700: #0369a1;

    --mb-green:      #16a34a;
    --mb-green-bg:   #eafaf0;
    --mb-red:        #e11d48;
    --mb-red-bg:     #fdecef;
    --mb-amber:      #d97706;
    --mb-amber-bg:   #fef3e2;
    --mb-slate:      #6b7280;
    --mb-slate-bg:   #f1f2f4;

    --mb-ink:        #1c1f23;
    --mb-ink-soft:   #6b7280;
    --mb-ink-faint:  #9aa1a9;
    --mb-line:       #e8e9ec;
    --mb-page-bg:    #f5f6f8;

    --mb-radius:     12px;
    --mb-radius-sm:  10px;
    --mb-radius-pill:999px;
}

/* ---------- Page shell ---------- */
.page-head{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    margin-bottom:20px;
}
.page-head h1{
    margin:0 0 4px;
    font-size:22px;
    font-weight:700;
    color:var(--mb-ink);
    letter-spacing:-.01em;
}
.page-head p{
    margin:0;
    font-size:13.5px;
    color:var(--mb-ink-soft);
}

.page-head-back{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:13.5px;
    font-weight:600;
    color:var(--mb-ink-soft);
    text-decoration:none;
    margin-bottom:10px;
}

.page-head-back:hover{
    color:var(--mb-ink);
}

/* ---------- Card shell ---------- */
.card{
    background:#fff;
    border:1px solid var(--mb-line);
    border-radius:var(--mb-radius);
    box-shadow:0 1px 2px rgba(20,30,40,.03);
    overflow:visible;
    max-width:640px;
}

.card-body{
    padding:26px 28px;
}

.card-footer{
    padding:16px 28px;
    border-top:1px solid var(--mb-line);
    background:#fff;
    display:flex;
    justify-content:flex-end;
    gap:8px;
}

/* ---------- Form ---------- */
.form-group{
    margin-bottom:18px;
}

.form-group:last-child{
    margin-bottom:0;
}

.form-label{
    display:block;
    margin-bottom:6px;
    font-size:13.5px;
    font-weight:600;
    color:var(--mb-ink);
}

.form-control{
    width:100%;
    padding:10px 14px;
    border:1px solid var(--mb-line);
    border-radius:var(--mb-radius-sm);
    font-size:14px;
    color:var(--mb-ink);
    background:#fff;
    transition:border-color .15s ease, box-shadow .15s ease;
    font-family:inherit;
}

.form-control:focus{
    outline:none;
    border-color:var(--mb-accent-500);
    box-shadow:0 0 0 3px var(--mb-accent-100);
}

select.form-control{
    cursor:pointer;
    appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 12px center;
    padding-right:36px;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:16px;
}

.form-hint{
    margin-top:6px;
    font-size:12.5px;
    color:var(--mb-ink-faint);
}

.form-error{
    margin-top:6px;
    font-size:12.5px;
    color:var(--mb-red);
}

.form-control.is-invalid{
    border-color:var(--mb-red);
}

.form-control.is-invalid:focus{
    box-shadow:0 0 0 3px var(--mb-red-bg);
}

/* ---------- Buttons ---------- */
.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:9px 18px;
    border-radius:var(--mb-radius-sm);
    font-size:13.5px;
    font-weight:600;
    text-decoration:none;
    cursor:pointer;
    border:1px solid var(--mb-line);
    transition:background .15s ease, border-color .15s ease;
}

.btn-light{
    background:#fff;
    color:var(--mb-ink);
}

.btn-light:hover{
    background:var(--mb-page-bg);
    border-color:#d5d7db;
}

.btn-primary{
    background:var(--mb-accent-500);
    color:#fff;
    border-color:var(--mb-accent-500);
}

.btn-primary:hover{
    background:var(--mb-accent-600);
    border-color:var(--mb-accent-600);
}

@media (max-width: 600px){
    .form-row{
        grid-template-columns:1fr;
    }
}

@endsection

@section('content')

<a href="{{ route('admin.members.index') }}" class="page-head-back">
    ← Quay lại danh sách
</a>

<div class="page-head">
    <div>
        <h1>Sửa hội viên</h1>
        <p>Cập nhật thông tin tài khoản #{{ $user->id }}</p>
    </div>
</div>

<div class="card">

    <form method="POST" action="{{ route('admin.members.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="membership_type" class="form-label">Loại tài khoản</label>
                    <select id="membership_type"
                            name="membership_type"
                            class="form-control @error('membership_type') is-invalid @enderror">
                        <option value="free" {{ old('membership_type', $user->membership_type) == 'free' ? 'selected' : '' }}>
                            FREE
                        </option>
                        <option value="vip" {{ old('membership_type', $user->membership_type) == 'vip' ? 'selected' : '' }}>
                            VIP
                        </option>
                    </select>
                    @error('membership_type')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vip_expires_at" class="form-label">Hạn VIP</label>
                    <input type="date"
                           id="vip_expires_at"
                           name="vip_expires_at"
                           value="{{ old('vip_expires_at', optional($user->vip_expires_at)->format('Y-m-d')) }}"
                           class="form-control @error('vip_expires_at') is-invalid @enderror">
                    @error('vip_expires_at')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                    <div class="form-hint">Bỏ trống nếu không phải hội viên VIP</div>
                </div>

            </div>

        </div>

        <div class="card-footer">
            <a href="{{ route('admin.members.index') }}" class="btn btn-light">
                Hủy
            </a>
            <button type="submit" class="btn btn-primary">
                Lưu thay đổi
            </button>
        </div>

    </form>

</div>

@endsection