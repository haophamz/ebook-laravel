@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">


<div>
    <h1>Gói thành viên</h1>
    <p>Quản lý các gói VIP trên hệ thống.</p>
</div>


</div>

<div class="card">


<div class="table-head">

    <div>
        <h3>Danh sách gói thành viên</h3>
        <span>{{ $plans->total() }} gói</span>
    </div>
</div>

<div class="table-wrap">

    <table class="table">

        <thead>

            <tr>
                <th>ID</th>
                <th>Tên gói</th>
                <th>Số tháng</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th width="180">Thao tác</th>
            </tr>

        </thead>

        <tbody>

        @forelse($plans as $plan)

            <tr>

                <td>
                    #{{ $plan->id }}
                </td>

                <td>

                    <strong>
                        {{ $plan->name }}
                    </strong>

                    @if($plan->description)

                        <div style="font-size:13px;color:#6b7280;margin-top:4px;">
                            {{ Str::limit($plan->description,60) }}
                        </div>

                    @endif

                </td>

                <td>
                    {{ $plan->months }} tháng
                </td>

                <td>
                    {{ number_format($plan->price) }}đ
                </td>

            

                <td>

                    @if($plan->active)

                        <span class="status-link status-active">
                            Hoạt động
                        </span>

                    @else

                        <span class="status-link status-locked">
                            Tạm khóa
                        </span>

                    @endif

                </td>

                <td class="action-cell">

                    <div class="action-group">

                        <a href="{{ route('admin.vip-plans.edit',$plan) }}"
                           class="btn-edit">
                            Sửa
                        </a>
                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7"
                    class="text-center">

                    Chưa có gói thành viên nào

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="card-footer">
    {{ $plans->links() }}
</div>


</div>

@endsection
