@extends('layouts.dashboard')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Jobcard Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Jobcard</li>
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
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
              <h3 class="card-title p-2">Ticket Number : </h3>
              <span class="form-control w-25 p-2">{{$jobcards->ticket_number}}</span>
              @if (!$jobcards->isClosed)
              <a href="{{route('jobcard.closeTicket',$jobcards->id)}}" class="btn btn-success p-2 ml-auto">Close Ticket</a>
              @else
              <a href="#" class="btn btn-secondary p-2 ml-auto">Ticket Closed</a>
              @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Jobcard Detail
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Jobcard Num. :</dt>
                                <dd class="col-sm-8">{{$jobcards->jobcard_number}}</dd>
                                <dt class="col-sm-4">Problem Desc. :</dt>
                                <dd class="col-sm-8">{{$jobcards->problem_desc}}</dd>
                                <dt class="col-sm-4">Service :</dt>
                                <dd class="col-sm-8">{{$jobcards->service_type}}</dd>
                                <dt class="col-sm-4">Status :</dt>
                                <dd class="col-sm-8">{{$jobcards->status}}</dd>
                                <dt class="col-sm-4">Remarks :</dt>
                                <dd class="col-sm-8">{{$jobcards->remarks}}</dd>
                                <dt class="col-sm-4">Brief Of Work :</dt>
                                <dd class="col-sm-8">{{$jobcards->brief_of_work}}</dd>
                                <dt class="col-sm-4">CSE Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->cse_name}}</dd>

                                <dd class="col-sm-12 border-bottom""></dd>

                                <dt class="col-sm-4">Date Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->date_time}}</dd>
                                <dt class="col-sm-4">Arrival Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->arrival_time}}</dd>
                                <dt class="col-sm-4">Working Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->time_working}}</dd>
                                <dt class="col-sm-4">Complete Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->time_complete}}</dd>
                                <dt class="col-sm-4">Leave Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->time_leave}}</dd>
                                <dt class="col-sm-4">Waiting Time :</dt>
                                <dd class="col-sm-8">{{$jobcards->waiting_time}}</dd>
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Sparepart Replacement
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                @forelse ($spareparts as $spareparts)
                                <dt class="col-sm-4">Part Name :</dt>
                                <dd class="col-sm-8">{{$spareparts->part_name}}</dd>
                                <dt class="col-sm-4">Part Number :</dt>
                                <dd class="col-sm-8">{{$spareparts->part_number}}</dd>
                                <dt class="col-sm-4">Part Serial :</dt>
                                <dd class="col-sm-8">{{$spareparts->part_serial}}</dd>
                                <dt class="col-sm-4">Qty :</dt>
                                <dd class="col-sm-8">{{$spareparts->qty}}</dd>
                                <dd class="col-sm-12 border-bottom""></dd>
                                @empty
                                <dd class="col-sm-12">No Sparepart</dd>
                                @endforelse
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">General Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Client Information
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_customer_name}}</dd>
                                <dt class="col-sm-4">Site Location :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_site_location_name}}</dd>
                                <dt class="col-sm-4">Site Address :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_site_location_address}}</dd>
                                <dt class="col-sm-4">Machine ID :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_machine_id}}</dd>
                                <dt class="col-sm-4">Machine Status :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_machine_status}}</dd>
                                <dt class="col-sm-4">PIC Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_pic_name}}</dd>
                                <dt class="col-sm-4">PIC No.HP :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_pic_hp}}</dd>
                                <dt class="col-sm-4">Activation Date :</dt>
                                <dd class="col-sm-8">{{$jobcards->client_activation_date}}</dd>
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                BP Information
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_company_name}}</dd>
                                <dt class="col-sm-4">Address :</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_company_address}}</dd>
                                <dt class="col-sm-4">PIC Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_pic_name}}</dd>
                                <dt class="col-sm-4">PIC Contact :</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_contact_number}}</dd>
                                <dt class="col-sm-4">Email :</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_email}}</dd>
                                <dt class="col-sm-4">Bank Name / Project:</dt>
                                <dd class="col-sm-8">{{$jobcards->bp_bank_name}}</dd>
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Product Information
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->product_name}}</dd>
                                <dt class="col-sm-4">Brand :</dt>
                                <dd class="col-sm-8">{{$jobcards->brand_name}}</dd>
                                <dt class="col-sm-4">Type Series :</dt>
                                <dd class="col-sm-8">{{$jobcards->type_series}}</dd>
                                <dt class="col-sm-4">Serial Num. :</dt>
                                <dd class="col-sm-8">{{$jobcards->serial_number}}</dd>
                                <dt class="col-sm-4">Entry Date :</dt>
                                <dd class="col-sm-8">{{$jobcards->date_of_entry}}</dd>
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                SP Information
                            </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_company_name}}</dd>
                                <dt class="col-sm-4">Address :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_company_address}}</dd>
                                <dt class="col-sm-4">PIC Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_pic_name}}</dd>
                                <dt class="col-sm-4">PIC Contact :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_contact_number}}</dd>
                                <dt class="col-sm-4">Email :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_email}}</dd>
                                <dt class="col-sm-4">Bank Name :</dt>
                                <dd class="col-sm-8">{{$jobcards->sp_bank_name}}</dd>
                            </dl>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
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
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["colvis"]
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
  });
</script>
@endsection
