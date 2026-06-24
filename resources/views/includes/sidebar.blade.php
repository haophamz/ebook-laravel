
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

<li>

        <i class="ti ti-ticket"></i>
        Mã giảm giá
    </a>
</li>

<li>

        <i class="ti ti-shopping-cart"></i>
        Đơn hàng
    </a>
</li>

<li>

        <i class="ti ti-credit-card"></i>
        Giao dịch
    </a>
</li>

<li>

        <i class="ti ti-chart-bar"></i>
        Doanh thu
    </a>
</li>
    </ul>

    <div class="sidebar-section-title">
        Quản lý
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="#">
                <i class="ti ti-users"></i>
                Người dùng
            </a>
        </li>

        <li>
            <a href="#">
                <i class="ti ti-heart"></i>
                Yêu thích
            </a>
        </li>

        <li>
            <a href="#">
                <i class="ti ti-chart-bar"></i>
                Thống kê
            </a>
        </li>

        <li>
            <a href="#">
                <i class="ti ti-settings"></i>
                Cài đặt
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">

        <div class="sidebar-footer-card">

            <p>
                Tổng số Ebook:
                <strong>0</strong>
            </p>

            <p>
                Người dùng:
                <strong>0</strong>
            </p>

        </div>

    </div>

</aside>
