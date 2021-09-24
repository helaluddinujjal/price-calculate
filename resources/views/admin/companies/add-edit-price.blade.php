@extends('layouts.admin.layouts')
@section('title')
    Price Section | {{str_replace('_',' ',config('app.name'))}}
@endsection
@push('style-link')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
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
              <h3 class="card-title"> Price</h3>
              <div class="mt-5">
                @include('include.session_msg')
              </div>
            </div>
            <!-- /.card-header -->
            <form @if (!empty($pricesData->id))
              action="{{url('admin/price')}}"
            @endif method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body table-responsive">
                <table  class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    @foreach ($companies as $company)
                    <th>
                      <h4>{{$company->name}}</h4>
                      <hr>
                      <a href="{{$company->url}}" class="btn btn-info">Go to Shop</a>
                    </th>
                    @endforeach
                  </tr>
                  <tr>
                    <th>ID</th>
                    <th>Season</th>
                    <th>Type</th>
                    <th>Flower Type</th>
                    @foreach ($companies as $company)
                    <th>Unit Price</th> 
                    @endforeach
                    <th></th>
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
                        @foreach ($companies as $company)
                        @php
                            foreach ($priceArr as $value) {
                             
                              if ($value['category_id']==$category->id && $value['company_id']==$company->id) {
                                $price=$value['price'];
                              }
                            }
                        @endphp
                            <td>
                              <input type="number" min="0" step="any" name="price[]" value="{{!empty($price)?$price:0}}">
                              <input type="hidden" name="ids[]" value="{{$category->id}}-{{$company->id}}">
                            </td>
                        @endforeach
                        <td></td> 
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="10"><button type="submit" class="btn btn-outline-success btn-block">Submit</button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </form>
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
    <!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
{{-- <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> --}}
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>

<script>
  $(function () {
    $("#datatable").DataTable({
      "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ],
        order: [ 1, 'asc' ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
  });

</script>
@endpush