@extends('layouts.dashboard')
@section('title')
Yaksa Harmoni Global | Data Detail Products
@endsection
@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products Detail Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Products Detail</li>
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
        <form action="{{route('pd.store')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Product</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>ID Number</label>
                  <input type="text" name="tb_id_number" class="form-control">
                </div>
                <div class="form-group">
                  <label>Serial Number</label>
                  <input type="text" name="tb_serial_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="tb_product_name" class="form-control">
                  </div>
                <div class="form-group">
                  <label>Brand Name</label>
                  <input type="text" name="tb_brand_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Type Series</label>
                  <input type="text" name="tb_type_series" class="form-control">
                </div>
                <div class="form-group">
                  <label>Entry Date</label>
                  <input type="date" name="tb_entry_date" class="form-control">
                </div>
                <div class="form-group">
                  <label>Activation Date</label>
                  <input type="date" name="tb_activation_date" class="form-control">
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
      <h3 class="card-title">Products</h3>

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
              <th>ID Number</th>
              <th>Serial Number</th>
              <th>Product Name</th>
              <th>Type Series</th>
              <th>Brand Name</th>
              <th>Date Of Entry</th>
              <th>Activation Date</th>
              <th>Tools</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($pd as $pd)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pd->id_number}}</td>
                        <td>{{$pd->serial_number}}</td>
                        <td>{{$pd->product_name}}</td>
                        <td>{{$pd->type_series}}</td>
                        <td>{{$pd->brand_name}}</td>
                        <td>{{$pd->date_of_entry}}</td>
                        <td>{{$pd->activation_date}}</td>
                        <td>
                            <button onclick="edit('{{$pd->id}}')" class="btn btn-success float-right mr-2"><i class="fa fa-pencil-alt"></i></button>
                            <a onclick="return confirm('are you sure?')" class="btn btn-danger float-right mr-2" href="{{route('pd.delete',['id'=>$pd->id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" align="center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>ID Number</th>
                <th>Serial Number</th>
                <th>Product Name</th>
                <th>Type Series</th>
                <th>Brand Name</th>
                <th>Date Of Entry</th>
                <th>Activation Date</th>
                <th>Tools</th>
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
                            <label for="tb_pd_id_number" class="form-label">ID Number</label>
                            <input type="text" id="tb_pd_id_number" name="tb_pd_id_number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_serial_number" class="form-label">Serial Number</label>
                            <input type="text" id="tb_pd_serial_number" name="tb_pd_serial_number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_product_name" class="form-label">Product Name</label>
                            <input type="text" id="tb_pd_product_name" name="tb_pd_product_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_brand_name" class="form-label">Brand Name</label>
                            <input type="text" id="tb_pd_brand_name" name="tb_pd_brand_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_type_series" class="form-label">Type Series</label>
                            <input type="text" id="tb_pd_type_series" name="tb_pd_type_series" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_entry_date" class="form-label">Entry Date</label>
                            <input type="date" id="tb_pd_entry_date" name="tb_pd_entry_date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tb_pd_activation_date" class="form-label">Activation Date</label>
                            <input type="date" id="tb_pd_activation_date" name="tb_pd_activation_date" class="form-control">
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
    var url = '/product/edit/'+id;
    var link = '/product/update/'+id;
    $.ajax({
        url : url,
        method: 'get',
        success: function(response) {
            $('#form-update').prop('action', link);
            $('#tb_pd_id_number').val(response['id_number']);
            $('#tb_pd_serial_number').val(response['serial_number']);
            $('#tb_pd_product_name').val(response['product_name']);
            $('#tb_pd_brand_name').val(response['brand_name']);
            $('#tb_pd_type_series').val(response['type_series']);
            $('#tb_pd_entry_date').val(response['date_of_entry']);
            $('#tb_pd_activation_date').val(response['activation_date']);
            $('#update-modal').modal('show');
        }
    });
}
function closeModal(){
    $('#update-modal').modal('hide');
}
</script>
@endsection
