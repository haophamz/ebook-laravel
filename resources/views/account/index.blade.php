@extends('layouts.app')

@section('content')

<style>

.account-page{
    max-width:1400px;
    margin:auto;
    padding:40px 20px;
}

.account-layout{
    display:grid;
    grid-template-columns:280px 1fr;
    gap:25px;
}

.account-sidebar{
    background:#181818;
    border:1px solid #2a2a2a;
    border-radius:20px;
    overflow:hidden;
}

.account-content{
    background:#181818;
    border:1px solid #2a2a2a;
    border-radius:20px;
    padding:30px;
}

@media(max-width:900px){

    .account-layout{
        grid-template-columns:1fr;
    }

}

</style>

<div class="account-page">

    <div class="account-layout">

        <div class="account-sidebar">

            @include('account.sidebar')

        </div>

        <div class="account-content">

            @yield('account-content')

        </div>

    </div>

</div>

@endsection