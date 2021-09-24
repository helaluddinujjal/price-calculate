<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Bloom-Checker')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
 
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
  @stack('style-link')
  {{-- <link rel="stylesheet" href="{{asset('css/custom.css')}}"?v='1.1'> --}}
  <!-- sweetalert2-->
  {{-- <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}"> --}}
  @stack('style')
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  <!-- Navbar -->
  @include('layouts.frontend.header')
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  {{-- @include('layouts.frontend.footer') --}}
  </div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<!-- Sweet alert 2 -->
{{-- <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.js')}}"></script>
@stack('script')
<script src="{{asset('js/custom.js')}}"></script>



</body>
</html>
