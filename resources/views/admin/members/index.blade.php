@extends('layouts.quanli')

@section('styles')
    @include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Quản lý hội viên</h1>
        <p>Danh sách thành viên hệ thống Ebook CMS</p>
    </div>
</div>

<div class="card">


<div class="card-header">

    <form method="GET" class="search-form">

        @if(request('type'))
            <input type="hidden"
                   name="type"
                   value="{{ request('type') }}">
        @endif

        <input type="text"
               name="keyword"
               value="{{ request('keyword') }}"
               placeholder="Tìm kiếm tên hoặc email...">

        <button type="submit">
            Tìm kiếm
        </button>

    </form>

</div>

<div class="card-body">

    <div class="filters">

        <a href="{{ route('admin.members.index') }}"
           class="{{ !request('type') ? 'active' : '' }}">
            Tất cả
        </a>

        <a href="{{ route('admin.members.index',['type'=>'vip']) }}"
           class="{{ request('type') == 'vip' ? 'active' : '' }}">
            VIP
        </a>

        <a href="{{ route('admin.members.index',['type'=>'free']) }}"
           class="{{ request('type') == 'free' ? 'active' : '' }}">
            FREE
        </a>

        <a href="{{ route('admin.members.index',['type'=>'active']) }}"
           class="{{ request('type') == 'active' ? 'active' : '' }}">
            Hoạt động
        </a>

        <a href="{{ route('admin.members.index',['type'=>'locked']) }}"
           class="{{ request('type') == 'locked' ? 'active' : '' }}">
            Đã khóa
        </a>

    </div>

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Loại tài khoản</th>
                <th>Hạn VIP</th>
                <th>Trạng thái</th>
                <th width="170">Thao tác</th>
            </tr>
        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>

                <td>
                    #{{ $user->id }}
                </td>

                <td>
                    {{ $user->name }}
                </td>

                <td>
                    {{ $user->email }}
                </td>

                <td>

                    @if($user->membership_type == 'vip')
                        <span class="badge bg-warning">
                            VIP
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            FREE
                        </span>
                    @endif

                </td>

                <td>

                    @if($user->vip_expires_at)
                        {{ \Carbon\Carbon::parse($user->vip_expires_at)->format('d/m/Y') }}
                    @else
                        -
                    @endif

                </td>

                <td>

                    @if($user->is_active)
                        <span class="status-link status-active">
                            Hoạt động
                        </span>
                    @else
                        <span class="status-link status-locked">
                            Đã khóa
                        </span>
                    @endif

                </td>

                <td class="action-cell">

                    <a href="{{ route('admin.members.edit',$user) }}" class="btn btn-light">
                        Sửa
                    </a>

                    @if($user->is_active)
                        <a href="#"
                           class="btn btn-danger"
                           onclick="event.preventDefault(); document.getElementById('lock-form-{{ $user->id }}').submit();">
                            Khóa
                        </a>

                        <form id="lock-form-{{ $user->id }}"
                              action="{{ route('admin.members.lock',$user) }}"
                              method="POST" style="display:none;">
                            @csrf
                            @method('PATCH')
                        </form>
                    @else
                        <a href="#"
                           class="btn btn-danger"
                           onclick="event.preventDefault(); document.getElementById('unlock-form-{{ $user->id }}').submit();">
                            Mở khóa
                        </a>

                        <form id="unlock-form-{{ $user->id }}"
                              action="{{ route('admin.members.unlock',$user) }}"
                              method="POST" style="display:none;">
                            @csrf
                            @method('PATCH')
                        </form>
                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center">
                    Chưa có hội viên nào
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="card-footer">
    {{ $users->withQueryString()->links() }}
</div>


</div>

@endsection