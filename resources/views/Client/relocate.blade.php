@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Data Client/Customer
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Client/Customer Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Client/Customer</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ Session::get('message') }}
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-6">
                <form action="{{route('cl.moveMachine')}}" method="post">
                    @csrf
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Relocate Form</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">

                        <div class="form-group">
                          <label>Customer Name</label>
                          <input value="{{$client->client_customer_name}}" type="text" name="tb_customer_name" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Machine ID</label>
                                <input value="{{$client->cid}}" type="hidden" name="tb_client_id">
                                <input value="{{$client->client_machine_id}}" type="text" name="tb_machine_id" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>PIC Name</label>
                                <input value="{{$client->client_pic_name}}" type="text" name="tb_pic_name" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <label>PIC No. HP</label>
                                <input value="{{$client->client_pic_hp}}" type="text" name="tb_pic_hp" class="form-control ">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>CS Engineer</label>
                                <select name="cb_cse" id="cb_cse" class="form-control select2 w-50">
                                    @forelse ($cse as $cs)
                                        <option
                                        @if ($cs->id == $client->customer_service_engineer_id)
                                        selected
                                        @endif
                                        value="{{$cs->id}}">{{$cs->nama_cse}}</option>
                                    @empty
                                        <option>No Data</option>
                                    @endforelse
                                </select>
                        </div>
                        <div class="form-group">
                          <label>Relocate Site Location</label>
                          <input value="{{$client->client_site_location_name}}" type="text" name="tb_site_location" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Relocate Site Address</label>
                          <input value="{{$client->client_site_location_address	}}" type="text" name="tb_site_address" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Activation Date</label>
                          <input value="{{$client->client_activation_date}}" type="date" name="dt_activation_date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Previous Client's Machine Data</div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Name:</dt>
                            <dl class="col-sm-8">{{$client->client_customer_name}}</dl>
                            <dt class="col-sm-4">CSE Name:</dt>
                            <dl class="col-sm-8">{{$client->nama_cse}}</dl>
                            <dt class="col-sm-4">Product Name:</dt>
                            <dl class="col-sm-8">{{$client->product_name}}</dl>
                            <dt class="col-sm-4">Machine ID:</dt>
                            <dl class="col-sm-8">{{$client->client_machine_id}}</dl>
                            <dt class="col-sm-4">Machine Status:</dt>
                            <dl class="col-sm-8">{{$client->client_machine_status}}</dl>
                            <dt class="col-sm-4">Pic Name:</dt>
                            <dl class="col-sm-8">{{$client->client_pic_name}}</dl>
                            <dt class="col-sm-4">Pic No.HP:</dt>
                            <dl class="col-sm-8">{{$client->client_pic_hp}}</dl>
                            <dt class="col-sm-4">Current location:</dt>
                            <dl class="col-sm-8">{{$client->client_site_location_name}}</dl>
                            <dt class="col-sm-4">Current Address:</dt>
                            <dl class="col-sm-8">{{$client->client_site_location_address}}</dl>
                            <dt class="col-sm-4">Activation Date:</dt>
                            <dl class="col-sm-8">{{$client->client_activation_date}}</dl>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('template/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    // console.log($('#cb_move_client').val());

  });
</script>
<script>
    $('.select2').select2({
        theme: 'bootstrap4'
    })
</script>
@endsection
