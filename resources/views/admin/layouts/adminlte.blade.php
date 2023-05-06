<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  {{-- <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">{{ __('nav.home') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="d-flex border p-1 rounded">
          <div class="image">
            <img src="{{ asset('img/admin.jfif') }}" style="width:40px;" class="img-circle img-fluid elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block nav-link">{{ auth()->guard('admin')->user()->name }}</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BLOG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/admin.jfif') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->guard('admin')->user()->name }}</a>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-globe"></i>
                  <p>
                    Language
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.dashboard',['my']) }}" class="nav-link {{ Request::is('admin/dashboard/my') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Myanmar</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.dashboard',['en']) }}" class="nav-link {{ Request::is('admin/dashboard/en') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>English</p>
                    </a>
                  </li>
                </ul>
              </li>
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                  <i class="nav-icon fa-solid fa-house"></i>
                  <p>{{ __('nav.dashboard') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.category.index') }}" class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-tags"></i>
                <p>{{ __('nav.category') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.product.index') }}" class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-box-open"></i>
                <p>{{ __('nav.product') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.profile.index') }}" class="nav-link {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-user-plus"></i>
                <p>{{ __('nav.user') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                <p>{{ __('nav.logout') }}</p>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="post" class="d-none">
                  @csrf
              </form>
              </a>
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
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{!! Toastr::message() !!}
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/counter_up.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>

@stack('js')
</body>
</html>
