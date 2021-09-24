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
          <h1><a class="btn btn-default" href="{{url('/admin/categories')}}">Flower Type List</a></h1>
          <div class="mt-3">
            @include('include.session_msg')
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/categories')}}">Flower Types</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <form @if (!empty($categoriesData->id))
      action="{{url('admin/add-edit-category',$categoriesData->id)}}"
    @else
    action="{{url('admin/add-edit-category')}}"  
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
              @if (!empty($seasonsArray))
                  <div class="form-group">
                    <label>Select Season</label>
                    <select class="form-control select2" style="width: 100%;" name="seasons" id="seasons">
                      <option selected="selected" value="">Select Season</option>
                      @foreach ($seasonsArray as $seasons)
                        <option value="{{$seasons->id}}" @if (!empty(old('seasons'))&&$seasons==old('seasons'))
                          selected=""
                        @elseif (isset($categoriesData->season_id)&&$categoriesData->season_id==$seasons->id)
                            selected
                        @endif>{{$seasons->name}}</option>
                      @endforeach
                    </select>
                  </div>
                @endif
                  @if (!empty($typesArray))
                      <div class="form-group">
                        <label>Select Type</label>
                        <select class="form-control select2" style="width: 100%;" name="types" id="types">
                          <option selected="selected" value="">Select Type</option>
                          @foreach ($typesArray as $types)
                            <option value="{{$types->id}}" @if (!empty(old('types'))&&$types==old('types'))
                              selected=""
                            @elseif (isset($categoriesData->type_id)&&$categoriesData->type_id==$types->id)
                                selected
                            @endif>{{$types->name}}</option>
                          @endforeach
                        </select>
                      </div>
                @endif
              <div class="form-group">
                <label for="categoriesName">Flower Type</label>
                <input type="text" id="categoriesName" class="form-control" name="name" placeholder="Enter Flower Type Name" @if (!empty($categoriesData->name))
                  value="{{$categoriesData->name}}"  
                @else
                value="{{old('name')}}"  
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