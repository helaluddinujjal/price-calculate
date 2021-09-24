@extends('layouts.admin.layouts')
@section('title')
    Add Admin | {{str_replace('_',' ',config('app.name'))}}
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><a class="btn btn-default" href="{{url('/admin/admins')}}">Admin List</a></h1>
          <div class="mt-3">
            @include('include.session_msg')
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/admins')}}">Admins</a></li>
            <li class="breadcrumb-item active">Add Admin</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form action="{{url('admin/add-admin')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Admin</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="form-group">
                <label for="adminName">Admin Name</label>
                <input type="text" id="adminName" class="form-control" name="name" placeholder="Enter Admin Name" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label for="email">Admin Email</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="Enter Admin Email" value="{{old('email')}}">
              </div>
              <div class="form-group">
                <label for="password">Admin Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter Admin Password" value="{{old('password')}}">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12 text-center">
          <input type="submit" value="Add Admin" class="btn btn-info btn-lg w-50 mb-3">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
@endsection