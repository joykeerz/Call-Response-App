@extends('layouts.dashboard')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Jobcard</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>
                  Replacement parts Form
                </h4>
                <p class="card-text text-muted">Complete the form below</p>
            </div>
            <div class="card-body">
                <form action="{{route('jobcard.stepThreeStore', $jobcardId)}}" method="post">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Part Num.</th>
                                <th>Qty</th>
                                <th>


                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="addRow">Add</a>
                                        <input type="hidden" name="tb_id_jobcard" value="{{$jobcardId}}">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">
                                    <div class="form-group">
                                        <div class="form-group">
                                          <select class="form-control" name="cb_part_number[]" id="cb_part_number[]">
                                            @forelse ($spareparts as $sp)
                                            <option value="{{$sp->id}}">{{$sp->part_number}}</option>
                                            @empty
                                            <option>No Data</option>
                                            @endforelse
                                          </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tb_qty[]" id="tb_qty[]">
                                    </div>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
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
<!-- Page specific script -->
<script>
$('thead').on('click', '#addRow', function () {
    var tr = `
    <tr>
        <td scope="row">
            <div class="form-group">
                <div class="form-group">
                    <select class="form-control" name="cb_part_number[]" id="cb_part_number[]">
                    @forelse ($spareparts as $sp)
                    <option value="{{$sp->id}}">{{$sp->part_number}}</option>
                    @empty
                    <option>No Data</option>
                    @endforelse
                    </select>
                </div>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" name="tb_qty[]" id="tb_qty[]">
            </div>
        </td>
        <td>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="deleteRow">Remove</a>
        </td>
    </tr>
    `
    $('tbody').append(tr);
});
$('tbody').on('click', '#deleteRow', function () {
    $(this).parent().parent().remove();
})
</script>
@endsection
