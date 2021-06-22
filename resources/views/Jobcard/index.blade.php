@extends('layouts.dashboard')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title')
Yaksa Harmoni Global | New Jobcard
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create New Jobcard</h1>
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

@section('content')
<form action="{{route('jobcard.stepOneStore')}}" method="post">
    @csrf
<div class="row">
        <div class="col-12 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                      Call Ticket Form
                    </h4>
                    <p class="card-text text-muted">Complete the form below</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control select2" style="width: 100%;" name="tb_customer" id="tb_customer">
                            @forelse ($customerData as $cd)
                            <option value="{{$cd->id}}">{{$cd->client_customer_name}}</option>
                            @empty
                                <option>No Data</option>
                            @endforelse
                        </select>
                        <small class="form-text text-muted">type customer name to search</small>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>Bussiness Partner</label>
                                <select class="form-control w-50 select2" style="width: 100%;" name="cb_bp" id="cb_bp">
                                    @forelse ($bpData as $bpData)
                                    <option value="{{$bpData->id}}">{{$bpData->bp_company_name}}</option>
                                    @empty
                                        <option>No Data</option>
                                    @endforelse
                                </select>
                                <small class="form-text text-muted">you can leave this empty</small>
                            </div>
                            <div class="col-6">
                                <label>Service Partner</label>
                                <select class="form-control w-50 select2" style="width: 100%;" name="cb_sp" id="cb_sp">
                                    @forelse ($spData as $spData)
                                    <option value="{{$spData->id}}">{{$spData->sp_company_name}}</option>
                                    @empty
                                        <option>No Data</option>
                                    @endforelse
                                </select>
                                <small class="form-text text-muted">you can leave this empty</small>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="tb_customer">Customer</label>
                        <input type="text" class="form-control" name="tb_customer" id="tb_customer">
                        <small id="tb_customer_help" class="form-text text-muted">Insert customer name to show info</small>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>Client/Customer</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($customerData as $cd)
                                <tr>
                                    <td>
                                      {{$cd->client_customer_name}}
                                    </td>
                                </tr>
                              @empty
                                <tr>
                                    <td>No Data</td>
                                </tr>
                              @endforelse

                          </table>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="tb_pic">PIC Contact</label>
                        <input type="text" class="form-control" id="tb_pic" name="tb_pic">
                        <small id="tb_pic_help" class="form-text text-muted">Insert phone or email</small>
                    </div> --}}
                    <div class="form-group">
                        <label for="tb_problem_desc">Problem Desc.</label>
                        <textarea name="tb_problem_desc" id="tb_problem_desc" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tb_date_time">Date & Time</label>
                        <input class="form-control" type="datetime-local" name="tb_date_time" id="tb_date_time">
                    </div>
                    <a name="" id="" class="btn btn-outline-danger" href="#" role="button">Cancel</a>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                      Machine Information
                    </h4>
                    <p class="card-text text-muted">Show machine information with machine id</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Machine ID</label>
                        <select class="form-control select2" style="width: 100%;" name="tb_id_number" id="tb_id_number">
                            @forelse ($machineData as $md)
                            <option value="{{$md->id}}">{{$md->id_number}}</option>
                            @empty
                                <option>No Data</option>
                            @endforelse
                        </select>
                        <small class="form-text text-muted">type machine id to search machine</small>
                    </div>
                    {{-- <div class="form-group">
                        <label for="myInput">Machine ID</label>
                        <input type="text" class="form-control" id="myInput" name="tb_id_number">
                        <small class="form-text text-muted">type machine id to show machine info</small>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Brand</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($machineData as $md)
                                    <tr>
                                      <td>{{$md->id_number}}</td>
                                      <td>{{$md->product_name}}</td>
                                      <td>{{$md->brand_name}}</td>
                                    </tr>
                                  @empty
                                    <tr>
                                        <td colspan="3">No Data</td>
                                    </tr>
                                  @endforelse

                              </table>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</form>
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
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })

    //Initialize datatable 1
    var table = $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "paging":   false,
      "info":     false,
      sDom: 'lrtip'
    });

    //Initialize datatable 2
    var table2 = $("#example2").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "paging":   false,
      "info":     false,
      sDom: 'lrtip'
    });

    //fungsi search datatable dari textbox
    $('#myInput').on( 'keyup', function () {
        table.search( this.value ).draw();
    });

    //fungsi search datatable dari textbox
    $('#tb_customer').on( 'keyup', function () {
        table2.search( this.value ).draw();
    });

});
</script>
@endsection
