@extends('layouts.admin.layouts')
@section('title')
    Account Settings | {{str_replace('_',' ',config('app.name'))}}
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          {{-- admin details settings --}}
          <div class="col-md-8 offset-2">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('include.session_msg')
              <form action="{{url('admin/account-settings')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input type="email" name="email" class="form-control" value="{{$adminDetails->email}}">
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name"  type="text" class="form-control" value="{{$adminDetails->name}}">
                  </div>
                  <div class="form-group">
                    <label for="new_pass">New Password</label>
                    <input id="new_pass" name="new_pass" type="password" class="form-control" placeholder="Enter New Password">
                  </div>
                  <div class="form-group">
                    <label for="confirm_pass">Confirm Password</label>
                    <input id="confirm_pass" name="confirm_pass" type="password" class="form-control" placeholder="Confirm New Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection