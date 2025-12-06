<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Otto | Yönetim Paneli</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">


    @yield('customcss')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/otto.png') }}" alt="ottologo" width="300">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        role="button">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('img/otto.png') }}" alt="ottologo" class="" style="opacity: 1" width="220">

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Yönetim Paneli
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">SİPARİŞ İŞLEMLERİ</li>
                        <!-- Ürünler -->
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'SALES')
                        <li class="nav-item">
                            <a href="{{ route(name: 'products') }}"
                                class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Ürünler</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'SALES')
                        <li class="nav-item">
                            <a href="{{ route(name: 'orders') }}"
                                class="nav-link {{ Route::currentRouteName() == 'orders' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>Tüm Siparişler</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'SALES')
                        <li class="nav-item">
                            <a href="{{ route(name: 'approvedOrders') }}"
                                class="nav-link {{ Route::currentRouteName() == 'approvedOrders' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>Onaylı Siparişler</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'MANUFACTURING')
                        <li class="nav-item">
                            <a href="{{ route(name: 'manufacturing') }}"
                                class="nav-link {{ Route::currentRouteName() == 'manufacturing' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-industry"></i>
                                <p>İmalat Hattı</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'ASSEMBLY')
                        <li class="nav-item">
                            <a href="{{ route(name: 'assembly') }}"
                                class="nav-link {{ Route::currentRouteName() == 'assembly' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>Montaj Hattı</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'ACCOUNTING')
                        <li class="nav-item">
                            <a href="{{ route(name: 'accounting') }}"
                                class="nav-link {{ Route::currentRouteName() == 'accounting' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Muhasebe Birimi</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER' || Auth::user()->unit == 'CARGO')
                        <li class="nav-item">
                            <a href="{{ route(name: 'shipping') }}"
                                class="nav-link {{ Route::currentRouteName() == 'shipping' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>Sevk Depo</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
                        <li class="nav-header">RAPORLAMA</li>
                        <li class="nav-item">
                            <a href="{{ route(name: 'reporting') }}"
                                class="nav-link {{ Route::currentRouteName() == 'reporting' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Satış Raporları</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
                        <li class="nav-header">PERSONEL İŞLEMLERİ</li>
                        <li class="nav-item">
                            <a href="{{ route(name: 'employees') }}"
                                class="nav-link {{ Route::currentRouteName() == 'employees' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Personel Listesi</p>
                            </a>
                        </li>
                        @endif
                        <!-- Admin işlemleri -->
                        @if (Auth::user()->userType == 'ADMIN')
                        <li class="nav-item">
                            <a href="{{ route('management') }}"
                                class="nav-link {{ Route::currentRouteName() == 'management' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Yönetim</p>
                            </a>
                        </li>
                        @endif
                        <!-- Çıkış -->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Çıkış Yap</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; {!! date('Y') !!} <a href="https://www.ottoteknik.com.tr">Otto Teknik</a>.</strong>
            Tüm hakları saklıdır.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.1
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    @yield('customjs')
</body>

</html>