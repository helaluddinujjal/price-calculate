<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Disable Account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- sweetalert2-->
  {{-- <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">  --}}
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>Disabled</b> Account!!</a>
    </div>
    <div class="card-body">
        @include('include.demo_session_msg')
        <div class="input-group mb-3">
         Hi {{!empty($name)?$name:''}}, Your Account has been disable by the admin. Please contact with admin to recover your account.
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
          </div>
          <!-- /.col -->
        </div>
        <hr>
      <p class="mb-0">
        <a href="{{'/'}}" class="text-center">Login</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Sweet alert 2 -->
{{-- <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>  --}}
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.js')}}"></script>
</body>
</html>