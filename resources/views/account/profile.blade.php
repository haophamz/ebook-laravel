@extends('account.layout')

@section('account-content')

<div class="content-header">

    <h1 class="page-title">
        Quản lý tài khoản
    </h1>

    <p class="page-desc">
        Cập nhật thông tin cá nhân của bạn.
    </p>

</div>

<form method="POST"
      action="{{ route('account.update') }}">

    @csrf

    <div class="profile-card">

        <div class="profile-left">

            <div class="form-group">

                <label>Họ và tên</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', Auth::user()->name) }}">

                @error('name')

                    <small class="error">
                        {{ $message }}
                    </small>

                @enderror

            </div>

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    class="form-control"
                    value="{{ Auth::user()->email }}"
                    readonly>

            </div>

            <div class="form-group">

                <label>Loại tài khoản</label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ Auth::user()->isVip() ? 'VIP MEMBER' : 'FREE MEMBER' }}"
                    readonly>

            </div>

            <button
                type="submit"
                class="btn-save">

                <i class="ti ti-device-floppy"></i>
                Lưu thay đổi

            </button>

        </div>


</form>

<style>

.content-header{
    margin-bottom:30px;
}

.page-desc{
    color:#8b8b95;
}

.profile-card{
    display:grid;
    grid-template-columns:1fr 260px;
    gap:40px;
}

.profile-right{
    text-align:center;
}

.avatar-large{
    width:130px;
    height:130px;
    border-radius:50%;
    border:4px solid #18c29c;
}

.btn-save{
    margin-top:20px;
    background:#18c29c;
    color:#fff;
    border:none;
    padding:14px 22px;
    border-radius:12px;
    cursor:pointer;
}

.error{
    color:#ff6b6b;
}

@media(max-width:992px){

    .profile-card{
        grid-template-columns:1fr;
    }

}

</style>

@endsection