
<aside class="sidebar">

<div class="sidebar-logo">


    <div class="sidebar-logo-text">
        <span>ECOBOOK</span>
        <small>CMS</small>
    </div>
</div>

    <div class="sidebar-section-title">
        Tổng quan
    </div>

    <ul class="sidebar-menu">

<li>
    <a href="{{ route('admin.revenue.index') }}"
       class="{{ request()->routeIs('admin.revenue.*') ? 'active' : '' }}">
        <i class="ti ti-chart-bar"></i>
        <span>Doanh thu</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.books.create') }}"
       class="{{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
        <i class="ti ti-book-upload"></i>
        <span>Upload Ebook</span>
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
        <span>Danh mục</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.members.index') }}"
       class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
        <i class="ti ti-user"></i>
        <span>Hội viên</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.banners.index') }}"
       class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
        <i class="ti ti-photo"></i>
        <span>Banner</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.vip-plans.index') }}"
       class="{{ request()->routeIs('admin.vip-plans.*') ? 'active' : '' }}">
        <i class="ti ti-crown"></i>
        <span>Gói thành viên</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.coupons.index') }}"
       class="{{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
        <i class="ti ti-ticket"></i>
        <span>Mã giảm giá</span>
    </a>
</li>

<li>
    <a href="{{ route('admin.support.index') }}"
       class="{{ request()->routeIs('admin.support.*') ? 'active' : '' }}">
        <i class="ti ti-headset"></i>
        <span>Hỗ trợ</span>
    </a>
</li>


</aside>
