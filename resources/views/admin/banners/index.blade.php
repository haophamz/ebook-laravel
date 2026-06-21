@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Quản lý Banner</h1>
        <p>Quản lý banner hiển thị ngoài trang chủ.</p>
    </div>
</div>

<div class="card">


<div class="table-head">

    <div>
        <h3>Banner</h3>
        <span>{{ $banners->total() }} banner</span>
    </div>

    <a href="{{ route('admin.banners.create') }}"
       class="btn-create">
        + Thêm Banner
    </a>

</div>

<div class="table-wrap">

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Link</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th width="180">Thao tác</th>
            </tr>
        </thead>

        <tbody>

        @forelse($banners as $banner)

            <tr>

                <td>#{{ $banner->id }}</td>

                <td>

                    <img src="{{ asset('storage/'.$banner->image) }}"
                         style="width:180px;height:70px;object-fit:cover;border-radius:8px;">

                </td>

                <td>

                    @if($banner->url)

                        <a href="{{ $banner->url }}"
                           target="_blank">
                            {{ Str::limit($banner->url,40) }}
                        </a>

                    @else

                        -

                    @endif

                </td>

                <td>
                    {{ $banner->sort_order }}
                </td>

                <td>

                    @if($banner->status)

                        <span class="status-link status-active">
                            Hiển thị
                        </span>

                    @else

                        <span class="status-link status-locked">
                            Ẩn
                        </span>

                    @endif

                </td>

                <td class="action-cell">

                    <div class="action-group">

                        <a href="{{ route('admin.banners.edit',$banner) }}"
                           class="btn-edit">
                            Sửa
                        </a>

                        <form action="{{ route('admin.banners.destroy',$banner) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Xóa banner này?')">
                                Xóa
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="text-center">

                    Chưa có banner nào

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="card-footer">
    {{ $banners->links() }}
</div>


</div>

@endsection
