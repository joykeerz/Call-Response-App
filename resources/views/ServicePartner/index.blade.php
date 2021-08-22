@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Data Service Partner
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Service Partner Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Service Partner</li>
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
        <form action="{{route('sp.store')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Service Partner</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Company Name</label>
                  <input required type="text" name="tb_company_name" class="form-control">
                  @error('tb_company_name')
                      <small style="color: red">this field is required</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Company Address</label>
                  <input required type="text" name="tb_company_address" class="form-control">
                  @error('tb_company_address')
                      <small style="color: red">this field is required</small>
                  @enderror
                </div>
                {{-- <div class="form-group">
                  <label>PIC Name</label>
                  <input type="text" name="tb_pic_name" class="form-control">
                  @error('tb_pic_name')
                      <small style="color: red">this field is required</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Contact Number</label>
                  <input type="text" name="tb_contact_number" class="form-control">
                  @error('tb_contact_number')
                      <small style="color: red">this field is required</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="tb_email" class="form-control">
                  @error('tb_email')
                      <small style="color: red">this field is required</small>
                  @enderror
                </div> --}}
                <table class="table">
                    <thead>
                        <th>PIC Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary" id="addRow">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </th>
                    </thead>
                    <tbody id="picTable">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input  type="text" name="tb_pic_name[]" class="form-control">
                                    @error('tb_pic_name')
                                        <small style="color: red">this field is required</small>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input  type="text" name="tb_contact_number[]" class="form-control">
                                    @error('tb_contact_number')
                                        <small style="color: red">this field is required</small>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input  type="text" name="tb_email[]" class="form-control">
                                    @error('tb_email')
                                        <small style="color: red">this field is required</small>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                  <label>Bank Name</label>
                  <input required type="text" name="tb_bank_name" class="form-control">
                  @error('tb_bank_name')
                      <small style="color: red">this field is required</small>
                  @enderror
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
      <h3 class="card-title">Service Partners</h3>

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
              <th>Email</th>
              <th>Bank Name</th>
              <th>Details Info</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($sps as $sp)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sp->sp_company_name}}</td>
                        <td>{{$sp->sp_company_address}}</td>
                        <td>{{$sp->sp_pic_name}}</td>
                        <td>{{$sp->sp_contact_number}}</td>
                        <td>{{$sp->sp_email}}</td>
                        <td>{{$sp->sp_bank_name}}</td>
                        <td>
                            <button onclick="edit('{{$sp->id}}')" class="btn btn-success float-right mr-2"><i class="fa fa-pencil-alt"></i></button>
                            <a onclick="return  confirm('are you sure?')" class="btn btn-danger float-right mr-2" href="{{route('sp.delete',['id'=>$sp->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                <th>Company Name</th>
                <th>Company Address</th>
                <th>PIC Name</th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>Bank Name</th>
                <th>Details Info</th>
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
                            <label for="tb_sp_company_name" class="form-label">Company Name</label>
                            <input type="text" id="tb_sp_company_name" name="tb_sp_company_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_sp_company_address" class="form-label">Company Address</label>
                            <input type="text" id="tb_sp_company_address" name="tb_sp_company_address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_sp_pic_name" class="form-label">PIC Name</label>
                            <input type="text" id="tb_sp_pic_name" name="tb_sp_pic_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_sp_contact_number" class="form-label">Contact Number</label>
                            <input type="text" id="tb_sp_contact_number" name="tb_sp_contact_number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_sp_email" class="form-label">Email</label>
                            <input type="text" id="tb_sp_email" name="tb_sp_email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_sp_bank_name" class="form-label">Bank Name</label>
                            <input type="text" id="tb_sp_bank_name" name="tb_sp_bank_name" class="form-control">
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
    var url = '/sp/edit/'+id;
    var link = '/sp/update/'+id;
    $.ajax({
        url : url,
        method: 'get',
        success: function(response) {
            $('#form-update').prop('action', link);
            $('#tb_sp_company_name').val(response['sp_company_name']);
            $('#tb_sp_company_address').val(response['sp_company_address']);
            $('#tb_sp_pic_name').val(response['sp_pic_name']);
            $('#tb_sp_contact_number').val(response['sp_contact_number']);
            $('#tb_sp_email').val(response['sp_email']);
            $('#tb_sp_bank_name').val(response['sp_bank_name']);
            $('#update-modal').modal('show');
        }
    });
}
function closeModal(){
    $('#update-modal').modal('hide');
}

$('#addRow').click(function (e) {
    e.preventDefault();
    const row = `<tr>
                    <td>
                        <div class="form-group">
                            <input type="text" name="tb_pic_name[]" class="form-control">
                            @error('tb_pic_name')
                                <small style="color: red">this field is required</small>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="tb_contact_number[]" class="form-control">
                            @error('tb_contact_number')
                                <small style="color: red">this field is required</small>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="tb_email[]" class="form-control">
                            @error('tb_email')
                                <small style="color: red">this field is required</small>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="deleteRow">Remove</a>
                    </td>
                </tr>`;
    $('#picTable').append(row);
});
$('tbody').on('click', '#deleteRow', function () {
    $(this).parent().parent().remove();
})
</script>
@endsection
