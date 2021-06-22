@extends('layouts.dashboard')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Main Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('title')
    Yaksa Harmoni Global | Dashboard
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Ticket</span>
            <span class="info-box-number">{{$totalTicket}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Responded</span>
            <span class="info-box-number">{{$respondedTicket}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Resolved</span>
            <span class="info-box-number">{{$resolvedTicket}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Pending</span>
            <span class="info-box-number">{{$pendingTicket}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Recent Jobcards</h3>

      <div class="card-tools">
        <a href="{{route('jobcard.stepOneGet')}}" class="btn btn-outline-primary btn-tool">Create new</a>
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Jobcard Number</th>
              <th>Ticket Number</th>
              <th>Machine ID</th>
              <th>Customer</th>
              <th>Ticket Status</th>
              <th>Tools</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($jobcards as $jobcard)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$jobcard->jobcard_number}}</td>
                    <td>{{$jobcard->ticket_number}}</td>
                    <td>{{$jobcard->product_detail_id}}</td>
                    <td>{{$jobcard->client_customer_name}}</td>
                    <td>
                        @if (!$jobcard->isClosed)
                            <span class="badge badge-success">Open</span>
                        @else
                            <span class="badge badge-danger">Closed</span>
                        @endif
                    </td>
                    <td><a onclick="return confirm('see details ?')" class="btn btn-outline-secondary float-right mr-2" href="{{route('jobcard.jobcardDetail',['id'=>$jobcard->id])}}"><i class="fa fa-eye"></i></a></td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->
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
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/dist/js/demo.js') }}"></script>
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
