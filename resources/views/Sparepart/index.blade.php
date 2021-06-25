@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Data Sparepart
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sparepart Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Sparepart</li>
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
        <form action="{{route('spp.store')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Sparepart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Part Number</label>
                  <input type="text" name="tb_part_number" class="form-control">
                </div>
                <div class="form-group">
                  <label>Serial Number</label>
                  <input type="text" name="tb_serial_number" class="form-control">
                </div>
                <div class="form-group">
                  <label>Part Name</label>
                  <input type="text" name="tb_part_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Date Entry</label>
                  <input type="date" name="tb_date_entry" class="form-control">
                </div>
                <div class="form-group">
                  <label>Date Out</label>
                  <input type="date" name="tb_date_out" class="form-control">
                </div>
                <div class="form-group">
                <label for="cb_condition">Condition</label>
                <select class="form-control" name="cb_condition" id="cb_condition">
                    <option>New</option>
                    <option>Used</option>
                </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Sparepart</h3>

      <div class="card-tools">
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
              <th>Part Number</th>
              <th>Part Serial</th>
              <th>Part Name</th>
              <th>Date Entry</th>
              <th>Date Out</th>
              <th>Condition</th>
              <th>Tools</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($spareparts as $sparepart)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sparepart->part_number}}</td>
                        <td>{{$sparepart->part_serial}}</td>
                        <td>{{$sparepart->part_name}}</td>
                        <td>{{$sparepart->part_date_of_entry}}</td>
                        <td>{{$sparepart->part_out_date}}</td>
                        <td>{{$sparepart->part_condition}}</td>
                        <td>
                            <button onclick="edit('{{$sparepart->id}}')" class="btn btn-success float-right mr-2"><i class="fa fa-pencil-alt"></i></button>
                            <a onclick="return confirm('are you sure?')" class="btn btn-danger float-right mr-2" href="{{route('spp.delete',['id'=>$sparepart->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" align="center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Part Number</th>
                <th>Part Serial</th>
                <th>Part Name</th>
                <th>Date Entry</th>
                <th>Date Out</th>
                <th>Condition</th>
                <th>Tools</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Data Sparepart
    </div>
    <!-- /.card-footer-->

    <!-- Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service Partner</h5>
            <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            </div>
            <div class="modal-body">
                <form id="form-update" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbPartNumber" class="form-label">Part Number</label>
                            <input type="text" id="tbPartNumber" name="tbPartNumber" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbSerialNumber" class="form-label">Serial Number</label>
                            <input type="text" id="tbSerialNumber" name="tbSerialNumber" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbPartName" class="form-label">Part Name</label>
                            <input type="text" id="tbPartName" name="tbPartName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbDateEntry" class="form-label">Date Entry</label>
                            <input type="date" id="tbDateEntry" name="tbDateEntry" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbDateOut" class="form-label">Date Out</label>
                            <input type="date" id="tbDateOut" name="tbDateOut" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="cbCondition" class="form-label">Condition</label>
                            <select class="form-control" name="cbCondition" id="cbCondition">
                                <option>New</option>
                                <option>Used</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
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
<script>
function edit(id){
    var url = '/sparepart/edit/'+id;
    var link = '/sparepart/update/'+id;
    $.ajax({
        url : url,
        method: 'get',
        success: function(response) {
            $('#form-update').prop('action', link);
            $('#tbPartNumber').val(response['part_number']);
            $('#tbSerialNumber').val(response['part_serial']);
            $('#tbPartName').val(response['part_name']);
            $('#tbDateEntry').val(response['part_date_of_entry']);
            $('#tbDateOut').val(response['part_out_date']);
            $('#cbCondition').val(response['part_condition']);
            $('#update-modal').modal('show');
        }
    });
}
function closeModal(){
    $('#update-modal').modal('hide');
}
</script>
@endsection
