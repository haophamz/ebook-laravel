@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">

<div>

<h1>Người dùng</h1>

<p>Danh sách thành viên.</p>

</div>

<a href="{{ route('admin.revenue.index') }}" class="btn-edit">

Quay lại

</a>

</div>

<div class="card">

<table>

<thead>

<tr>

<th>ID</th>

<th>Tên</th>

<th>Email</th>

<th>VIP</th>

<th>Ngày tạo</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>{{ $user->id }}</td>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>

@if($user->membership_type=='vip')

<span class="badge success">

VIP

</span>

@else

<span class="badge">

FREE

</span>

@endif

</td>

<td>

{{ $user->created_at->format('d/m/Y') }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

{{ $users->links() }}

@endsection