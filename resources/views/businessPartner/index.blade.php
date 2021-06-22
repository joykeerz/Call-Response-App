@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Data Business Partner
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Business Partner Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Business Partner</li>
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
        <form action="{{route('bp.store')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Business Partner</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Company Name</label>
                  <input type="text" name="tb_company_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Company Address</label>
                  <input type="text" name="tb_company_address" class="form-control">
                </div>
                <div class="form-group">
                  <label>PIC Name</label>
                  <input type="text" name="tb_pic_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Contact Number</label>
                  <input type="text" name="tb_contact_number" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Business Partners</h3>

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
                      <th>Company Name</th>
                      <th>Company Address</th>
                      <th>PIC Name</th>
                      <th>Contact Name</th>
                      <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($bps as $bp)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$bp->bp_company_name}}</td>
                                <td>{{$bp->bp_company_address}}</td>
                                <td>{{$bp->bp_pic_name}}</td>
                                <td>{{$bp->bp_contact_number}}</td>
                                <td>
                                    <button onclick="edit('{{$bp->id}}')" class="btn btn-success float-right mr-2"><i class="fa fa-pencil-alt"></i></button>
                                    <a onclick="return  confirm('are you sure?')" class="btn btn-danger float-right mr-2" href="{{route('bp.delete',['id'=>$bp->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>PIC Name</th>
                        <th>Contact Name</th>
                        <th>tools</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Business Partner</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tb_bp_company_name" class="form-label">Company Name</label>
                                    <input type="text" id="tb_bp_company_name" name="tb_bp_company_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tb_bp_company_address" class="form-label">Company Address</label>
                                    <input type="text" id="tb_bp_company_address" name="tb_bp_company_address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tb_bp_pic_name" class="form-label">PIC Name</label>
                                    <input type="text" id="tb_bp_pic_name" name="tb_bp_pic_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tb_bp_contact_number" class="form-label">Contact Number</label>
                                    <input type="text" id="tb_bp_contact_number" name="tb_bp_contact_number" class="form-control">
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
<script>
function edit(id){
    var url = '/bp/edit/'+id;
    var link = '/bp/update/'+id;
    $.ajax({
        url : url,
        method: 'get',
        success: function(response) {
            $('#form-update').prop('action', link);
            $('#tb_bp_company_name').val(response['bp_company_name']);
            $('#tb_bp_company_address').val(response['bp_company_address']);
            $('#tb_bp_pic_name').val(response['bp_pic_name']);
            $('#tb_bp_contact_number').val(response['bp_contact_number']);
            $('#update-modal').modal('show');
        }
    });
}
function closeModal(){
    $('#update-modal').modal('hide');
}
</script>
@endsection
