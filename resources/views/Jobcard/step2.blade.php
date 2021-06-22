@extends('layouts.dashboard')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
<form action="{{route('jobcard.stepTwoStore')}}" method="post">
    @csrf
<div class="row">
        <div class="col-12 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                      Jobcard Form
                    </h4>
                    <p class="card-text text-muted">Complete the form below</p>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ticket Number</label>
                        <h5 class="form-control w-25">{{\Carbon\Carbon::now()->format('Ymd')}}{{$jobcardId}}</h5>
                        <input type="hidden" name="tb_ticket_number" value="{{\Carbon\Carbon::now()->format('Ymd')}}{{$jobcardId}}">
                        <input type="hidden" name="tb_id" value="{{$jobcardId}}">
                        <small id="tb_ticket_number_help" class="form-text text-muted">Ticket number auto generated and can't be changed</small>
                    </div>

                    <div class="form-group">
                        <label for="tb_jobcard_number">Jobcard Number</label>
                        <input type="text" class="form-control" id="tb_jobcard_number" name="tb_jobcard_number">
                        <small id="tb_jobcard_number_help" class="form-text text-muted">Insert jobcard number</small>
                    </div>

                    {{-- <div class="form-group">
                        <label for="cb_service_type">Service Type</label>
                        <div class="form-group">
                          <select class="form-control" name="cb_service_type" id="cb_service_type">
                            <option>installation</option>
                            <option>preventive maintenance</option>
                            <option>corrective maintenance</option>
                            <option>upgrade</option>
                            <option>force majeure</option>
                            <option>development</option>
                            <option>training</option>
                            <option>other</option>
                          </select>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="cb_service_type">Jobcard Number</label>
                        <div class="row border rounded">
                            <div class="col-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="installation">
                                        installation
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="preventive maintenance">
                                        preventive maintenance
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="corrective maintenance">
                                        corrective maintenance
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="upgrade">
                                        upgrade
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <labelclass="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="force majeure">
                                        force majeure
                                    </labelclass=>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="development">
                                        development
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="training">
                                        training
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cb_service_type[]" id="cb_service_type" value="other">
                                        other
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="dt_arrival_time">Arrival Time</label>
                        <input class="form-control" type="datetime-local" name="dt_arrival_time" id="dt_arrival_time">
                    </div>

                    <div class="form-group">
                        <label for="dt_working_time">Start Working Time</label>
                        <input class="form-control" type="datetime-local" name="dt_working_time" id="dt_working_time">
                    </div>

                    <div class="form-group">
                        <label for="dt_complete_time">Complete Time</label>
                        <input class="form-control" type="datetime-local" name="dt_complete_time" id="dt_complete_time">
                    </div>

                    <div class="form-group">
                        <label for="dt_leave_time">Leave Time</label>
                        <input class="form-control" type="datetime-local" name="dt_leave_time" id="dt_leave_time">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="dt_waiting_time">Waiting Time</label>
                                <input class="form-control" type="text" name="dt_waiting_time" id="dt_waiting_time">
                                <small id="dt_waiting_time_help" class="form-text text-muted">date empty allowed</small>
                            </div>
                            <div class="col-6">
                                <label for="tb_waiting_note">Waiting Note</label>
                                <input class="form-control" type="text" name="tb_waiting_note" id="tb_waiting_note">
                                <small id="tb_waiting_note_help" class="form-text text-muted">text empty allowed</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cb_status">Status</label>
                        <div class="form-group">
                          <select class="form-control" name="cb_status" id="cb_status">
                            <option>Complete</option>
                            <option>Pending</option>
                            <option>Reschedule</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tb_remarks">Remarks</label>
                        <input type="text" class="form-control" id="tb_remarks" name="tb_remarks">
                    </div>

                    <div class="form-group">
                        <label for="tb_brief">Brief of work</label>
                        <textarea rows="4" class="form-control" id="tb_brief" name="tb_brief"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tb_cse_name">CSE Name</label>
                        <input type="text" class="form-control" id="tb_cse_name" name="tb_cse_name">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label for="cbx_sparepart" class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="cbx_sparepart" id="cbx_sparepart" value="true">
                                Sparepart Replacement
                            </label>
                        </div>
                    </div>

                    <a name="" id="" class="btn btn-outline-danger" href="#" role="button">Cancel</a>
                    <button type="submit" class="btn btn-primary">Next</button>
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
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
    $('#dt_working_time').change(function (e) {
        e.preventDefault();
        // let d1 = new Date($('#dt_arrival_time').val());
        // let d2 = new Date($('#dt_working_time').val());
        // let diff = Math.abs(d1-d2);
        // console.log(diff/60000);
        // $('#dt_waiting_time').val(diff/60000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = '/jobcard/countWaitingTime';
        $.ajax({
            url : url,
            method: 'post',
            data: {
                dt_arrival_time: $('#dt_arrival_time').val(),
                dt_working_time: $('#dt_working_time').val(),
            },
            success: function(response) {
                console.log(response);
                $('#dt_waiting_time').val(response);
            }
        });
    });
</script>
@endsection
