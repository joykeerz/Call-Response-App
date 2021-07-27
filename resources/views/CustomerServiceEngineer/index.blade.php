@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Customer Service Engineer
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Customer Service Engineer</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Customer Service Engineer</li>
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
        <form action="{{route('cse.store')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Customer Service Engineer</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>CSE Name</label>
                  <input type="text" name="tb_cse_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Initial</label>
                  <input type="text" name="tb_cse_initial" class="form-control">
                </div>
                <div class="form-group">
                  <label>Area</label>
                  <input type="text" name="tb_cse_area" class="form-control">
                </div>
                <div class="form-group">
                  <label>No. HP</label>
                  <input type="text" name="tb_cse_hp" class="form-control">
                </div>
                <div class="form-group">
                    <label>Service Partner</label>
                    <select class="form-control select2" style="width: 100%;" name="cb_sp" id="cb_sp">
                        @forelse ($sps as $sp)
                        <option value="{{$sp->id}}">{{$sp->sp_company_name}}</option>
                        @empty
                            <option>No Data</option>
                        @endforelse
                    </select>
                    <small class="form-text text-muted">type Service Partner name to search</small>
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
      <h3 class="card-title">Customer Service Engineer</h3>

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
              <th>CSE Name</th>
              <th>CSE Initial</th>
              <th>Area</th>
              <th>No. HP</th>
              <th>Detail Info</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($cse as $cse)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$cse->nama_cse}}</td>
                        <td>{{$cse->initial_cse}}</td>
                        <td>{{$cse->area_cse}}</td>
                        <td>{{$cse->hp_cse}}</td>
                        <td>
                            <button onclick="edit('{{$cse->id}}')" class="btn btn-success float-right mr-2"><i class="fa fa-pencil-alt"></i></button>
                            <a onclick="return  confirm('are you sure?')" class="btn btn-danger float-right mr-2" href="{{route('cse.delete',['id'=>$cse->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>CSE Name</th>
                <th>CSE Initial</th>
                <th>Area</th>
                <th>No. HP</th>
                <th>Detail Info</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    </div>
    <!-- /.card-footer-->

    <!-- Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer Service Engineer</h5>
            <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            </div>
            <div class="modal-body">
                <form id="form-update" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbCseName" class="form-label">CSE Name</label>
                            <input type="text" id="tbCseName" name="tbCseName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbCseInitial" class="form-label">Initial</label>
                            <input type="text" id="tbCseInitial" name="tbCseInitial" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbCseArea" class="form-label">Area</label>
                            <input type="text" id="tbCseArea" name="tbCseArea" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbCseHp" class="form-label">No. HP</label>
                            <input type="text" id="tbCseHp" name="tbCseHp" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Service Partner</label><br>
                            <label id="lblCurrent"></label>
                            <select class="form-control select2" style="width: 100%;" name="cbSp" id="cbSp">
                                @forelse ($sps as $sp)
                                <option value="{{$sp->id}}">{{$sp->sp_company_name}}</option>
                                @empty
                                    <option>No Data</option>
                                @endforelse
                            </select>
                            <small class="form-text text-muted">type Service Partner name to search</small>
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
    $('.select2').select2({
        theme: 'bootstrap4'
    })
  });
</script>

<script>
function edit(id){
    var url = '/cse/edit/'+id;
    var link = '/cse/update/'+id;
    $.ajax({
        url : url,
        method: 'get',
        success: function(response) {
            $('#form-update').prop('action', link);
            $('#tbCseName').val(response['nama_cse']);
            $('#tbCseInitial').val(response['initial_cse']);
            $('#tbCseArea').val(response['area_cse']);
            $('#tbCseHp').val(response['hp_cse']);
            $('#lblCurrent').html('Current : '+response['sp_company_name']);
            $('#update-modal').modal('show');
        }
    });
}
function closeModal(){
    $('#update-modal').modal('hide');
}
</script>
@endsection
