<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="" type="image/x-icon">
  @include('layout.header')
</head>
<body class="sidebar-mini sidebar-closed text-sm">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light pinkku ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar text-bold text-center" type="search" placeholder="Search" aria-label="Search" disabled value="{{ strtoupper(Session::get('nama')) }}">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="refresh">
            <i class="fas fa-sync"></i>
          </button>
        </div>
      </div>
      
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout', []) }}" role="button">
          <i class="fa fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar text-dark  pinkku2 elevation-1">
    <!-- Brand Logo -->
    <a href="{{ url('/home', []) }}" class="brand-link pink-gelapku">
      <h3 class="brand-image rounded-circle bg-info px-1 text-bold bg-danger border-none ml-2" style="padding-top:2px "><font color="gold">SI</font></h3>
      <span class="brand-text text-bold text-white" style="font-size: 17px;letter-spacing: 2px">KARTA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-1 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('img', 'background.jpg') }}" class="mt-3" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            nama
          </a>
          <span>
            <a href="{{ url('profil', []) }}" class="btn btn-xs btn-outline-secondary text-bold">
              ubah password
            </a>
          </span>
        </div>
      </div>
      <hr>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item hoverku">
              <a href="{{ url('home', []) }}" class="nav-link @yield('activekuHome')">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            
            <li class="nav-item hoverku">
              <hr>
              <a href="{{ url('identitas', []) }}" class="nav-link @yield('activekuIdentitas')">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Identitas
                </p>
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
    <!-- Content Header (Page header) -->
    <div class="container">
        <section class="content-header">
          <div class="">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('judul')</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="container">
                @yield('content')
            </div>
    

            
        </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm footerku">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layout.script')
@yield('script')
</body>
</html>