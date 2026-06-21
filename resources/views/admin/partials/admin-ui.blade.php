{{--
    admin-ui.blade.php
    CSS chung cho các trang quản lý trong khu vực Admin (Ebook CMS).
    Tone: xanh nước biển nhạt (sky), filter pill outline.

    Cách dùng trong mỗi trang:

        @section('styles')
            @include('admin.partials.admin-ui')
        @endsection

    Layout `quanli.blade.php` in @yield('styles') bên trong thẻ <style>,
    nên file này CHỈ chứa CSS thuần — không <link>, không @import.
--}}

:root{
    --mb-accent-50:  #f0f9ff;
    --mb-accent-100: #e0f2fe;
    --mb-accent-200: #bae6fd;
    --mb-accent-500: #0ea5e9;
    --mb-accent-600: #0284c7;
    --mb-accent-700: #0369a1;

    --mb-green:      #16a34a;
    --mb-green-bg:   #eafaf0;
    --mb-red:        #e11d48;
    --mb-red-bg:     #fdecef;
    --mb-amber:      #d97706;
    --mb-amber-bg:   #fef3e2;
    --mb-slate:      #6b7280;
    --mb-slate-bg:   #f1f2f4;

    --mb-ink:        #1c1f23;
    --mb-ink-soft:   #6b7280;
    --mb-ink-faint:  #9aa1a9;
    --mb-line:       #e8e9ec;
    --mb-page-bg:    #f5f6f8;

    --mb-radius:     12px;
    --mb-radius-sm:  10px;
    --mb-radius-pill:999px;
}

/* ==========================================================================
   PAGE HEAD
   ========================================================================== */
.page-head{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    margin-bottom:20px;
}
.page-head h1{
    margin:0 0 4px;
    font-size:22px;
    font-weight:700;
    color:var(--mb-ink);
    letter-spacing:-.01em;
}
.page-head p{
    margin:0;
    font-size:13.5px;
    color:var(--mb-ink-soft);
}

.page-head-back{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:13.5px;
    font-weight:600;
    color:var(--mb-ink-soft);
    text-decoration:none;
    margin-bottom:10px;
}

.page-head-back:hover{
    color:var(--mb-ink);
}

/* ==========================================================================
   CARD SHELL
   ========================================================================== */
.card{
    background:#fff;
    border:1px solid var(--mb-line);
    border-radius:var(--mb-radius);
    box-shadow:0 1px 2px rgba(20,30,40,.03);
    overflow:visible;
}

.card-header{
    padding:18px 22px;
    border-bottom:1px solid var(--mb-line);
    background:#fff;
    display:flex;
    justify-content:flex-end;
}

.card-body{
    padding:18px 22px 6px;
}

.card-footer{
    padding:16px 22px;
    border-top:1px solid var(--mb-line);
    background:#fff;
    display:flex;
    justify-content:flex-end;
}

/* Header dạng "table-head": tiêu đề bảng + nút tạo mới, dùng cho Categories/Books */
.table-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 22px;
    border-bottom:1px solid var(--mb-line);
}

.table-head h3{
    margin:0 0 2px;
    font-size:16px;
    font-weight:700;
    color:var(--mb-ink);
}

.table-head span{
    font-size:13px;
    color:var(--mb-ink-soft);
}

/* ==========================================================================
   SEARCH FORM (bo tròn, pill)
   ========================================================================== */
.search-form{
    display:flex;
    gap:8px;
    width:100%;
    max-width:320px;
}

.search-form input[type="text"]{
    flex:1;
    padding:9px 16px;
    border:1px solid var(--mb-line);
    border-radius:var(--mb-radius-pill);
    font-size:14px;
    color:var(--mb-ink);
    background:var(--mb-page-bg);
    transition:border-color .15s ease, background .15s ease;
}

.search-form input[type="text"]::placeholder{
    color:var(--mb-ink-faint);
}

.search-form input[type="text"]:focus{
    outline:none;
    border-color:var(--mb-accent-500);
    background:#fff;
    box-shadow:0 0 0 3px var(--mb-accent-100);
}

.search-form button{
    padding:9px 18px;
    border:none;
    border-radius:var(--mb-radius-pill);
    background:var(--mb-ink);
    color:#fff;
    font-size:13.5px;
    font-weight:600;
    cursor:pointer;
    transition:background .15s ease;
    white-space:nowrap;
}

.search-form button:hover{
    background:#000;
}

/* ==========================================================================
   FILTERS: pill outline
   ========================================================================== */
.filters{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-bottom:18px;
}

.filters a{
    padding:7px 18px;
    border-radius:var(--mb-radius-pill);
    font-size:13.5px;
    font-weight:500;
    color:var(--mb-ink-soft);
    background:transparent;
    border:1px solid var(--mb-line);
    text-decoration:none;
    transition:all .15s ease;
}

.filters a:hover{
    color:var(--mb-ink);
    border-color:#d5d7db;
}

.filters a.active{
    color:var(--mb-green);
    background:var(--mb-green-bg);
    border-color:#bdeacd;
    font-weight:600;
}

/* ==========================================================================
   BOOKS — ảnh bìa, tiêu đề sách, tác giả (dùng riêng cho trang Ebook)
   ========================================================================== */
.table-wrap{
    overflow-x:auto;
}

.book-cover{
    width:55px;
    height:75px;
    object-fit:cover;
    border-radius:8px;
    border:1px solid var(--mb-line);
}

.no-cover{
    width:55px;
    height:75px;
    background:var(--mb-page-bg);
    border:1px solid var(--mb-line);
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:10px;
    color:var(--mb-ink-faint);
    text-align:center;
}

.book-title{
    font-weight:600;
    color:var(--mb-ink);
    margin-bottom:3px;
}

.book-author{
    font-size:12.5px;
    color:var(--mb-ink-soft);
}

/* ==========================================================================
   TABLE
   ========================================================================== */
.table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

.table thead th{
    text-align:left;
    padding:11px 14px;
    font-size:12.5px;
    font-weight:600;
    color:var(--mb-ink-faint);
    background:transparent;
    border-bottom:1px solid var(--mb-line);
    white-space:nowrap;
}

.table tbody tr{
    transition:background .12s ease;
}

.table tbody tr:hover{
    background:#fafbfc;
}

.table tbody td{
    padding:14px;
    border-bottom:1px solid var(--mb-line);
    color:var(--mb-ink);
    vertical-align:middle;
}

.table tbody tr:last-child td{
    border-bottom:none;
}

.table tbody td:first-child{
    color:var(--mb-ink-faint);
    font-weight:500;
    font-size:13px;
}

.table .text-center{
    text-align:center;
    color:var(--mb-ink-soft);
    padding:40px 0;
    font-size:14px;
}

/* ==========================================================================
   BADGES (loại tài khoản, nhãn phụ...)
   ========================================================================== */
.badge{
    display:inline-flex;
    align-items:center;
    padding:3px 11px;
    border-radius:var(--mb-radius-pill);
    font-size:12px;
    font-weight:600;
}

.badge.bg-warning{
    color:var(--mb-amber);
    background:var(--mb-amber-bg);
}

.badge.bg-secondary{
    color:var(--mb-slate);
    background:var(--mb-slate-bg);
}

/* ==========================================================================
   STATUS: dạng text-link, không nền
   (dùng cho "Hoạt động" / "Đã khóa" / "Hiển thị" / "Ẩn" ...)
   ========================================================================== */
.status-link{
    font-size:13.5px;
    font-weight:600;
}

.status-active{
    color:var(--mb-green);
}

.status-locked{
    color:var(--mb-red);
}

/* Alias cho trang Categories: .status.published / .status.draft
   để không phải sửa lại class trong HTML cũ, vẫn theo tone chung */
.status{
    display:inline-flex;
    align-items:center;
    font-size:13.5px;
    font-weight:600;
}

.status.published{
    color:var(--mb-accent-600);
    background:none;
}

.status.draft{
    color:var(--mb-red);
    background:none;
}

/* ==========================================================================
   BUTTONS
   ========================================================================== */
.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    cursor:pointer;
    border:1px solid var(--mb-line);
    transition:background .15s ease, border-color .15s ease;
}

.btn + .btn{
    margin-left:6px;
}

.btn-light{
    background:#fff;
    color:var(--mb-ink);
}

.btn-light:hover{
    background:var(--mb-page-bg);
    border-color:#d5d7db;
}

.btn-primary{
    background:var(--mb-accent-500);
    color:#fff;
    border-color:var(--mb-accent-500);
}

.btn-primary:hover{
    background:var(--mb-accent-600);
    border-color:var(--mb-accent-600);
}

.btn-danger{
    background:#fff;
    color:var(--mb-red);
    border-color:#f6c4cf;
}

.btn-danger:hover{
    background:var(--mb-red-bg);
    border-color:var(--mb-red);
}

/* Alias cho trang Categories: .btn-create / .btn-edit / .btn-delete
   để giữ nguyên HTML cũ, chỉ đổi tone màu */
.btn-create{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:9px 18px;
    border-radius:var(--mb-radius-sm);
    font-size:13.5px;
    font-weight:600;
    text-decoration:none;
    background:var(--mb-accent-500);
    color:#fff;
    border:1px solid var(--mb-accent-500);
    transition:background .15s ease;
}

.btn-create:hover{
    background:var(--mb-accent-600);
    border-color:var(--mb-accent-600);
}

.btn-edit{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    background:#fff;
    color:var(--mb-ink);
    border:1px solid var(--mb-line);
    transition:background .15s ease, border-color .15s ease;
}

.btn-edit:hover{
    background:var(--mb-page-bg);
    border-color:#d5d7db;
}

.btn-delete{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
    background:#fff;
    color:var(--mb-red);
    border:1px solid #f6c4cf;
    cursor:pointer;
    transition:background .15s ease, border-color .15s ease;
}

.btn-delete:hover{
    background:var(--mb-red-bg);
    border-color:var(--mb-red);
}

.action-group{
    display:flex;
    align-items:center;
    gap:8px;
}

.action-cell{
    text-align:right;
    white-space:nowrap;
}

/* ==========================================================================
   FORM (dùng cho trang Create/Edit)
   ========================================================================== */
.form-group{
    margin-bottom:18px;
}

.form-group:last-child{
    margin-bottom:0;
}

.form-label{
    display:block;
    margin-bottom:6px;
    font-size:13.5px;
    font-weight:600;
    color:var(--mb-ink);
}

.form-control{
    width:100%;
    padding:10px 14px;
    border:1px solid var(--mb-line);
    border-radius:var(--mb-radius-sm);
    font-size:14px;
    color:var(--mb-ink);
    background:#fff;
    transition:border-color .15s ease, box-shadow .15s ease;
    font-family:inherit;
}

.form-control:focus{
    outline:none;
    border-color:var(--mb-accent-500);
    box-shadow:0 0 0 3px var(--mb-accent-100);
}

select.form-control{
    cursor:pointer;
    appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 12px center;
    padding-right:36px;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:16px;
}

.form-hint{
    margin-top:6px;
    font-size:12.5px;
    color:var(--mb-ink-faint);
}

.form-error{
    margin-top:6px;
    font-size:12.5px;
    color:var(--mb-red);
}

.form-control.is-invalid{
    border-color:var(--mb-red);
}

.form-control.is-invalid:focus{
    box-shadow:0 0 0 3px var(--mb-red-bg);
}

/* ==========================================================================
   PAGINATION
   ========================================================================== */
.card-footer nav > div:first-child{
    display:none;
}

.card-footer .pagination,
nav[role="navigation"] .pagination{
    display:flex;
    gap:4px;
    list-style:none;
    margin:0;
    padding:0;
}

.card-footer .pagination li span,
.card-footer .pagination li a,
nav[role="navigation"] .pagination li span,
nav[role="navigation"] .pagination li a{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:32px;
    height:32px;
    padding:0 8px;
    border-radius:8px !important;
    font-size:13.5px;
    font-weight:500;
    text-decoration:none;
    color:var(--mb-ink-soft);
    border:1px solid transparent;
    transition:all .15s ease;
}

.card-footer .pagination li a:hover,
nav[role="navigation"] .pagination li a:hover{
    background:var(--mb-page-bg);
    color:var(--mb-ink);
}

.card-footer .pagination li.active span,
nav[role="navigation"] .pagination li.active span{
    background:var(--mb-ink);
    color:#fff;
}

.card-footer .pagination li.disabled span,
nav[role="navigation"] .pagination li.disabled span{
    color:#c7cbd1;
}

nav[role="navigation"]{
    margin-top:20px;
}

nav[role="navigation"] > div{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* ==========================================================================
   RESPONSIVE
   ========================================================================== */
@media (max-width: 720px){
    .page-head{
        flex-direction:column;
        align-items:flex-start;
        gap:6px;
    }

    .card-header,
    .table-head{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
    }

    .search-form{
        max-width:100%;
    }

    .card-body{
        padding:16px;
        overflow-x:auto;
    }

    .table{
        min-width:680px;
    }

    .form-row{
        grid-template-columns:1fr;
    }
}