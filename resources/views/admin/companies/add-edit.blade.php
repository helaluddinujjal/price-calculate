@extends('layouts.admin.layouts')
@section('title')
    {{$title}} | {{str_replace('_',' ',config('app.name'))}}
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><a class="btn btn-default" href="{{url('/admin/companies')}}">Company List</a></h1>
          <div class="mt-3">
            @include('include.session_msg')
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/companies')}}">Companies</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form @if (!empty($companiesData->id))
      action="{{url('admin/add-edit-company',$companiesData->id)}}"
    @else
    action="{{url('admin/add-edit-company')}}"  
    @endif method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="form-group">
                <label for="companiesName">Company Name</label>
                <input type="text" id="companiesName" class="form-control" name="name" placeholder="Enter Company Name" @if (!empty($companiesData->name))
                  value="{{$companiesData->name}}"  
                @else
                value="{{old('name')}}"  
                @endif>
              </div>
              <div class="form-group">
                <label for="siteUrl">Site URL( https://)</label>
                <input type="text" id="siteUrl" class="form-control" name="url" placeholder="Enter Site Url" @if (!empty($companiesData->url))
                  value="{{$companiesData->url}}"  
                @else
                value="{{old('url')}}"  
                @endif>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12 text-center">
          <input type="submit" value="{{$title}}" class="btn btn-info btn-lg w-50 mb-3">
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
@endsection