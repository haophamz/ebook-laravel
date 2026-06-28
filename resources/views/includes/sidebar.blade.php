
<aside class="sidebar">

    <div class="sidebar-logo">
        <div class="sidebar-logo-mark"></div>
        <div class="sidebar-logo-text">
            Ebook CMS
        </div>
    </div>

    <div class="sidebar-section-title">
        Tổng quan
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('admin.dashboard') }}"  class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="ti ti-layout-dashboard"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.books.create') }}"  class="{{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                <i class="ti ti-book-upload"></i>
                Upload Ebook
            </a>
        </li>
<li>
    <a href="{{ route('admin.books.index') }}"
       class="{{ request()->routeIs('admin.books.index') ? 'active' : '' }}">
        <i class="ti ti-books"></i>
        <span>Danh sách Ebook</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.books.drafts') }}"
       class="{{ request()->routeIs('admin.books.drafts') ? 'active' : '' }}">
        <i class="ti ti-book-off"></i>
        <span>Bản nháp Ebook</span>
    </a>
</li>
<li>
    <a href="{{ route('admin.categories.index') }}"
       class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="ti ti-category"></i>
        Danh mục
    </a>
</li>

        <li>
    <a href="{{ route('admin.members.index') }}"
       class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
        <i class="ti ti-user"></i>
        Hội viên
    </a>
</li>
<li>
    <a href="{{ route('admin.banners.index') }}"
       class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
        <i class="ti ti-photo"></i>
        Banner
    </a>
</li>
<li>
    <a href="{{ route('admin.vip-plans.index') }}"
       class="{{ request()->routeIs('admin.vip-plans.*') ? 'active' : '' }}">
        <i class="ti ti-crown"></i>
        Gói thành viên
    </a>
</li>

<li class="{{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
    <a href="{{ route('admin.coupons.index') }}">
        <i class="ti ti-ticket"></i>
        Mã giảm giá
    </a>
</li>

<li>
    <li class="{{ request()->routeIs('admin.revenue.*') ? 'active' : '' }}">
    <a href="{{ route('admin.revenue.index')}}">
        <i class="ti ti-chart-bar"></i>
        <span>Doanh thu</span>
    </a>
</li>


</aside>
