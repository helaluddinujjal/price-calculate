@extends('layouts.admin.layouts')
@section('title')
    Price Calculate | {{str_replace('_',' ',config('app.name'))}}
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><a class="btn btn-default" href="{{url('/admin/dashboard')}}">Dashboard</a></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Prices</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Price Chart</h3>
              <div class="mt-5">
                @include('include.session_msg')
              </div>
            </div>
            <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table  class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    @php
                        $x=0
                    @endphp
                    @foreach ($companies as $company)
                    @php
                        $x=$x+1;
                    @endphp
                    <th colspan="2">
                      <h4>{{$company->name}}</h4>
                      <hr>
                      Total:&euro; <span id="columnT_{{$x}}">0.00</span>
                      <hr>
                      <a href="{{$company->url}}" class="btn btn-info">Visit Shop</a>
                    </th>
                    @endforeach
                  </tr>
                  <tr>
                    <th>ID</th>
                    <th>Season</th>
                    <th>Type</th>
                    <th>Flower Type</th>
                    <th>qty</th>
                    @foreach ($companies as $company)
                    <th>Unit Price(&euro;)</th> 
                    <th>Unit Total(&euro;)</th> 
                    @endforeach
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{!empty($category->season)?$category->season->name:"Unset"}}
                        <td>{{!empty($category->type)?$category->type->name:"Unset"}}
                        <td>{{$category->name}}
                        </td>
                        <td>
                          <input type="number" min="0" id="qty_{{$category->id}}" class="qty" value="0" cat="{{$category->id}}" autocomplete="off" >
                        </td>
                        @php
                            $x=0;
                        @endphp
                        @foreach ($companies as $company)
                        @php
                        $x=$x+1;
                            foreach ($priceArr as $value) {
                              if ($value['category_id']==$category->id && $value['company_id']==$company->id) {
                                $price=$value['price'];
                              }
                            }
                        @endphp
                            <td>
                              <p><span class="unitP_{{$category->id}}">{{!empty($price)?$price:0}}</span>
                              </p>
                            </td>
                            <td>
                              <p>
                                 <span class="unitT unitT_{{$category->id}} dis_unitT_{{$category->id}}_{{$x}} column_{{$x}}" id="unitT_{{$category->id}}">0.00</span>
                              </p>
                            </td>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@push('script')
<script>

</script>
@endpush