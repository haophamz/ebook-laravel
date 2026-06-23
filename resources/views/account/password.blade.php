@extends('account.layout')

@section('account-content')

<h1 class="page-title">
    Đổi mật khẩu
</h1>

<form method="POST"
      action="{{ route('account.password.update') }}">

@csrf

<div class="password-card">

    <div class="form-group">

        <label>
            Mật khẩu hiện tại
        </label>

        <input
            type="password"
            name="current_password"
            class="form-control">

    </div>

    <div class="form-group">

        <label>
            Mật khẩu mới
        </label>

        <input
            type="password"
            name="password"
            class="form-control">

    </div>

    <div class="form-group">

        <label>
            Xác nhận mật khẩu mới
        </label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control">

    </div>

    <button
        type="submit"
        class="btn-save">

        <i class="ti ti-lock"></i>
        Đổi mật khẩu

    </button>

</div>


</form>

<style>

.password-card{
    max-width:700px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#9ca3af;
}

.form-control{
    width:100%;
    height:56px;
    background:#1a1a1d;
    border:1px solid #2b2b31;
    border-radius:14px;
    padding:0 18px;
    color:#fff;
}

.form-control:focus{
    outline:none;
    border-color:#18c29c;
}

.btn-save{
    height:54px;
    padding:0 26px;
    border:none;
    border-radius:14px;
    background:#18c29c;
    color:#fff;
    font-weight:700;
    cursor:pointer;
}

.page-title{
    color:#fff;
    font-size:38px;
    margin-bottom:30px;
}

</style>

@endsection
