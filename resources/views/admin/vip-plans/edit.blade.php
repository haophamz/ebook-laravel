@extends('layouts.quanli')

@section('content')

<div class="page-head">
</div>

<div class="card plan-card">

<form action="{{ route('admin.vip-plans.update',$vip_plan) }}"
      method="POST">
@csrf
@method('PUT')

<div class="form-group">

    <label>Tên gói</label>

    <input type="text"
           name="name"
           class="input"
           value="{{ old('name',$vip_plan->name) }}"
           required>

</div>

<div class="grid">

    <div class="form-group">

        <label>Số tháng</label>

        <input type="number"
               name="months"
               class="input"
               min="1"
               value="{{ old('months',$vip_plan->months) }}"
               required>

    </div>

    <div class="form-group">

        <label>Giá (VNĐ)</label>

        <input type="number"
               name="price"
               class="input"
               min="0"
               value="{{ old('price',$vip_plan->price) }}"
               required>

    </div>

</div>

<div class="form-group">

    <label>Mô tả</label>

    <textarea
        name="description"
        class="textarea"
        rows="5">{{ old('description',$vip_plan->description) }}</textarea>

</div>
</div>

</div>

<div class="actions">

    <a href="{{ route('admin.vip-plans.index') }}"
       class="btn-back">
        Quay lại
    </a>

    <button type="submit"
            class="btn-upload">
        Cập nhật gói
    </button>

</div>

</form>

</div>

<style>

.plan-card{
    max-width:900px;
    background:#fff;
    border:1px solid #ececec;
    border-radius:18px;
    padding:28px;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#111827;
}

.input{
    width:100%;
    height:48px;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:0 16px;
    font-size:14px;
}

.input:focus,
.textarea:focus{
    outline:none;
    border-color:#111827;
}

.textarea{
    width:100%;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:12px 16px;
    resize:vertical;
}

.option-group{
    margin-bottom:16px;
}

.checkbox{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:14px;
    color:#111827;
}

.actions{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:25px;
    padding-top:20px;
    border-top:1px solid #f3f4f6;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:42px;
    padding:0 16px;
    text-decoration:none;
    background:#f3f4f6;
    color:#111827;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.btn-upload{
    height:42px;
    padding:0 18px;
    border:none;
    border-radius:10px;
    background:#111827;
    color:#fff;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
}

.btn-upload:hover{
    background:#000;
}

@media(max-width:768px){

    .grid{
        grid-template-columns:1fr;
    }

}

</style>

@endsection
