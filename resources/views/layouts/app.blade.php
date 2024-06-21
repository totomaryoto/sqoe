<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash;Alat Musik</title>
    <link rel="shortcut icon" href="{{ asset('assets_app/img/school.svg') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets_app/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_app/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets_app/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_app/css/select2-bootstrap4.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets_app/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_app/css/components.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="{{ asset('assets_app/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_app/js/sweetalert.min.js') }}"></script>

</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets_app/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">ALAT MUSIK</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">BASS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">MAIN MENU</li>

                        <li class="{{ setActive('admin/dashboard') }}"><a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span></a></li>

                        <li class="{{ setActive('admin/brand') }}"><a class="nav-link" href="{{ route('admin.brand.index') }}"><i class="fas fa-bell"></i>
                                <span>Brand</span></a></li>

                        <li class="{{ setActive('admin/category') }}"><a class="nav-link" href="{{ route('admin.category.index') }}"><i class="fas fa-folder"></i>
                                <span>Kategori</span></a></li>

                        <li class="{{ setActive('admin/item') }}"><a class="nav-link" href="#"><i class="fas fa-book-open"></i>
                                <span>Item</span></a></li>

                        <li class="menu-header">GALERI</li>

                        <li class="{{ setActive('admin/blog') }}"><a class="nav-link" href="{{ route('admin.blog.index') }}"><i class="fas fa-image"></i>
                                <span>Blog</span></a></li>

                        <li class="{{ setActive('admin/dealer') }}"><a class="nav-link" href="{{ route('admin.dealer.index') }}"><i class="fas fa-video"></i>
                                <span>Dealer</span></a></li>

                        <li class="menu-header">PENGATURAN</li>

                        <li class="{{ setActive('admin/header-description') }}"><a class="nav-link" href="{{ route('admin.header-description.index') }}"><i class="fas fa-laptop"></i>
                                <span>Header</span></a></li>

                        <li class="{{ setActive('admin/user') }}"><a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i> Users</a>
                        </li>

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{date('Y')}}
                    <div class="bullet"></div> ALAT MUSIK <div class="bullet"></div> All Rights
                    Reserved.
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets_app/modules/popper.js') }}"></script>
    <script src="{{ asset('assets_app/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_app/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets_app/js/stisla.js') }}"></script>
    <script src="{{ asset('assets_app/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets_app/js/scripts.js') }}"></script>
    <script src="{{ asset('assets_app/js/custom.js') }}"></script>
    <script>
        //active select2
        $(document).ready(function() {
            $('select').select2({
                theme: 'bootstrap4',
                width: 'style',
            });
        });

        //flash message
        @if(session() -> has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session() -> has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
    </script>
</body>

</html>