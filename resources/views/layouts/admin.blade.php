<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/solid.min.css"
        integrity="sha512-EHa6vH03/Ty92WahM0/tet1Qicl76zihDCkBnFhN3kFGQkC+mc86d7V+6y2ypiLbk3h0beZAGdUpzfMcb06cMg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Administrator</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-pink-light d-flex">
            <div class="navbar-brand text-pink-soft"><a href="{{ url('/admin') }}">
                    <h3> <span class="badge text-bg-dark">LTBeauty</span> Admin</h3>
                </a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle text-lavender"></i>
                    </button>
                    <div class="dropdown-menu bg-pink">
                        <a class="dropdown-item text-pink-soft" href="{{ url('/admin/post/add') }}">Thêm bài viết</a>
                        <a class="dropdown-item text-pink-soft" href="{{ url('/admin/product/add') }}">Thêm sản phẩm</a>
                        <a class="dropdown-item text-pink-soft" href="{{ url('/admin/order') }}">Thêm đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right bg-pink">
                        <a class="dropdown-item text-pink-soft" href="{{route('profile.edit')}}">Tài khoản</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-pink-soft">
                                Thoát
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-dark">
                <ul id="sidebar-menu">
                    <li class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <a href="{{ url('/admin') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-link {{ request()->is('admin/page*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/page') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-regular fa-file"></i>
                            </div>
                            Trang
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/page/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/admin/page') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ request()->is('admin/post*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/post') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-regular fa-newspaper"></i>
                            </div>
                            Bài viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/post/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/admin/post') }}">Danh sách</a></li>
                            <li><a href="{{ url('/admin/post/cat') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/product') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-solid fa-cube"></i>
                            </div>
                            Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/product/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/admin/product') }}">Danh sách</a></li>
                            <li><a href="{{ url('/admin/product/cat') }}">Danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ request()->is('admin/order*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/order') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            Bán hàng
                        </a>
                        <i class="arrow fas fa-angle-right text-pink-light"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/order') }}">Đơn hàng</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/user') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            Người dùng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/user/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/admin/user') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ request()->is('admin/role*') ? 'active' : '' }}">
                        <a href="{{ route('permission.add') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa-solid fa-unlock"></i>
                            </div>
                            Phân quyền
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ route('permission.add') }}">Quyền</a></li>
                            <li><a href="{{ url('/admin/role/add') }}">Thêm vai trò</a></li>
                            <li><a href="{{ url('/admin/role') }}">Danh sách vai trò</a></li>
                        </ul>
                    </li>

                    <!-- <li class="nav-link"><a>Bài viết</a>
                        <ul class="sub-menu">
                            <li><a>Thêm mới</a></li>
                            <li><a>Danh sách</a></li>
                            <li><a>Thêm danh mục</a></li>
                            <li><a>Danh sách danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link"><a>Sản phẩm</a></li>
                    <li class="nav-link"><a>Đơn hàng</a></li>
                    <li class="nav-link"><a>Hệ thống</a></li> -->

                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>

        @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>