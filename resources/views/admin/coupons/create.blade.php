@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Thêm mã giảm giá</h1>
        <p>Tạo coupon khuyến mãi mới.</p>
    </div>
</div>

<div class="card">

<form action="{{ route('admin.coupons.store') }}" method="POST">

    @csrf

    <div class="card-body">

        <div class="field">
            <label>Tên chương trình</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required>

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Mã giảm giá</label>

            <div style="display:flex;gap:10px;align-items:center;">

                <input
                    id="coupon_code"
                    type="text"
                    name="code"
                    class="form-control"
                    value="{{ old('code') }}"
                    required>

                <button
                    type="button"
                    class="btn-edit"
                    onclick="randomCode()">
                    Sinh mã
                </button>

            </div>

            @error('code')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Loại giảm</label>

            <select
                name="type"
                id="coupon_type"
                class="form-control"
                onchange="changeType()">

                <option value="percent"
                    {{ old('type')=='percent' ? 'selected' : '' }}>
                    Giảm theo %
                </option>

                <option value="fixed"
                    {{ old('type')=='fixed' ? 'selected' : '' }}>
                    Giảm theo tiền
                </option>

            </select>
        </div>

        <div class="field">
            <label id="value_label">Phần trăm giảm (%)</label>

            <input
                type="number"
                name="value"
                class="form-control"
                value="{{ old('value') }}"
                required>

            @error('value')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Đơn tối thiểu</label>

            <input
                type="number"
                name="min_order_amount"
                class="form-control"
                value="{{ old('min_order_amount',0) }}">
        </div>

        <div class="field" id="max_discount_box">
            <label>Giảm tối đa</label>

            <input
                type="number"
                name="max_discount"
                class="form-control"
                value="{{ old('max_discount') }}">
        </div>

        <div class="field">
            <label>Giới hạn lượt sử dụng</label>

            <input
                type="number"
                name="usage_limit"
                class="form-control"
                value="{{ old('usage_limit') }}">
        </div>

        <div class="field">
            <label>Ngày bắt đầu</label>

            <input
                type="datetime-local"
                name="started_at"
                class="form-control"
                value="{{ old('started_at') }}">
        </div>

        <div class="field">
            <label>Ngày kết thúc</label>

            <input
                type="datetime-local"
                name="expired_at"
                class="form-control"
                value="{{ old('expired_at') }}">
        </div>

        <div class="field">

            <label>
                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    {{ old('active',1) ? 'checked' : '' }}>

                Hoạt động
            </label>

        </div>

    </div>

    <div class="card-footer">

        <div class="action-group">

            <button
                type="submit"
                class="btn-create">
                Lưu mã giảm giá
            </button>

            <a
                href="{{ route('admin.coupons.index') }}"
                class="btn-edit">
                Quay lại
            </a>

        </div>

    </div>

</form>

</div>

<script>

function randomCode(){

    let chars='ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
    let code='';

    for(let i=0;i<8;i++){
        code+=chars.charAt(
            Math.floor(Math.random()*chars.length)
        );
    }

    document.getElementById('coupon_code').value=code;

}

function changeType(){

    let type=document.getElementById('coupon_type').value;
    let label=document.getElementById('value_label');
    let max=document.getElementById('max_discount_box');

    if(type==='percent'){

        label.innerHTML='Phần trăm giảm (%)';
        max.style.display='block';

    }else{

        label.innerHTML='Số tiền giảm (VNĐ)';
        max.style.display='none';

    }

}

changeType();

</script>

@endsection