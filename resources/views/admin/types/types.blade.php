@extends('layouts.admin.layouts')
@section('title')
    Types List | {{str_replace('_',' ',config('app.name'))}}
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
            <li class="breadcrumb-item active">Types</li>
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
              <h3 class="card-title">Type List</h3>
              <a href="{{url('admin/add-edit-type')}}" class="btn btn-success float-right">Add Type</a>
              <div class="mt-5">
                @include('include.session_msg')
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped display responsive nowrap">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Type Name</th>
                  <th>Action</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($types as $type)
                    <tr>
                      <td>{{$type->id}}</td>
                      <td>{{$type->name}}
                      </td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a class="btn btn-sm btn-info" href="{{url('admin/add-edit-type/'.$type->id)}}">Edit</a>
                          <a class="btn btn-sm btn-danger confirm-delete" record="type" recorded="{{$type->id}}" href="javascript:void(0)">Delete</a>
                        </div>
                      </td>
                      <td></td>
                    </tr>  
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