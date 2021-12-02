@extends('layouts.dashboard')
@section('title')
    Yaksa Harmoni Global | Data Client Customer
@endsection
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Client/Customer Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Client/Customer</li>
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
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
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
            <form action="{{ route('cl.store') }}" method="post">
                @csrf

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Input New Installation</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card border-primary shadow">
                            <div class="card-header">
                                Relocate
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Select to relocate</label>
                                    <select name="cb_move_client" id="cb_move_client" class="form-control select2">
                                        @forelse ($clients as $client)
                                            @if ($client->client_machine_status != 'moved')
                                                <option value="{{ $client->cid }}">Client:
                                                    {{ $client->client_customer_name }} | Machine ID:
                                                    {{ $client->client_machine_id }}</option>
                                            @endif
                                        @empty
                                            <option>No data</option>
                                        @endforelse
                                    </select>
                                    <small id="helpId" class="text-muted">type to search</small><br>
                                    <a href="#" id="relocateButton" class="btn btn-outline-primary mt-2">Relocate</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Customer Name</label>
                            <input required type="text" name="tb_customer_name" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Machine ID</label>
                                <input required type="text" name="tb_machine_id" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                {{-- <input type="hidden" name="cb_machine_status" value="new installation"> --}}
                                <label>Machine Status</label>
                                <select required name="cb_machine_status" id="cb_machine_status"
                                    class="form-control select2">
                                    <option value="New Installation">New Installation</option>
                                    <option value="No Contract">No Contract</option>
                                    <option value="Rental">Rental</option>
                                    <option value="Maintenance & Part">Maintenance & Part</option>
                                    <option value="Maintenance Only">Maintenance Only</option>
                                    <option value="Part Only">Part Only</option>
                                    <option value="OnCall">OnCall</option>
                                    {{-- <option value="Warranty">Warranty</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>PIC Name</label>
                                <input required type="text" name="tb_pic_name" class="form-control ">
                            </div>
                            <div class="col-md-6">
                                <label>PIC No. HP</label>
                                <input required type="text" name="tb_pic_hp" class="form-control ">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="card">
                                <div class="card-body">
                                    <label>Product Detail</label>
                                    <select required name="cb_product" id="cb_product" class="form-control select2">
                                        @forelse ($products as $product)
                                            <option value="{{ $product->id }}">SN: {{ $product->serial_number }}
                                            </option>
                                        @empty
                                            <option>No Data</option>
                                        @endforelse
                                    </select>
                                    <small id="helpId" class="text-muted">type serial number to search product
                                        detail</small><br>
                                    <dl class="row mt-3" id="listProductInfo">

                                    </dl>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>CS Engineer</label>
                            <select required name="cb_cse" id="cb_cse" class="form-control select2">
                                @forelse ($cse as $cs)
                                    @if ($cs->nama_cse != 'cse 1')
                                        <option value="{{ $cs->id }}">{{ $cs->nama_cse }}</option>
                                    @endif
                                @empty
                                    <option>No Data</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Site Location</label>
                            <input required type="text" name="tb_site_location" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Site Address</label>
                            <input required type="text" name="tb_site_address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Activation Date</label>
                            <input required type="date" name="dt_activation_date" class="form-control">
                        </div>
                        <div class="form-group jq-warranty">
                            <label>Warranty Duration</label>
                            <select required name="cb_warranty" id="cb_warranty" class="form-control select2">
                                <option selected value="none">none</option>
                                <option value="1 year">1 year</option>
                                <option value="2 years">2 years</option>
                                <option value="3 years">3 years</option>
                                <option value="4 years">4 years</option>
                                <option value="5 years">5 years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Operational Hours</label>
                            <select required name="cb_operational_hours" id="cb_operational_hours"
                                class="form-control select2">
                                <option selected value="none">none</option>
                                <option value="24 hours">24 hours</option>
                                <option value="6am-19pm all days">6am-19pm all days</option>
                                <option value="6am-19pm monday-friday">6am-19pm monday-friday</option>
                                <option value="8am-21pm all days">8am-21pm all days</option>
                                <option value="8am-21pm monday-friday">8am-21pm monday-friday</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
        {{-- <div class="col-md-6">
        <form action="{{route('cl.moveMachine')}}" method="post">
            @csrf
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Transfered Machine</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Select Client / Machine</label>
                        <select name="cb_client" id="cb_client" class="form-control select2">
                            @forelse ($clients as $client)
                                @if ($client->client_machine_status != 'moved')
                                    <option value="{{$client->cid}}">Client: {{$client->client_customer_name}} | Machine ID: {{$client->client_machine_id}}</option>
                                @endif
                            @empty
                                <option>No data</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <label>New Site Location</label>
                  <input type="text" name="tb_move_site_location" class="form-control">
                </div>
                <div class="form-group">
                  <label>New Site Address</label>
                  <input type="text" name="tb_move_site_address" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
    </div> --}}
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customers/Clients</h3>

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
                        <th>Customer Name</th>
                        <th>Machine ID</th>
                        <th>Machine Status</th>
                        <th>CSE</th>
                        <th>Product</th>
                        <th>PIC Name</th>
                        <th>PIC No.HP</th>
                        <th>Site Location</th>
                        <th>Site Address</th>
                        <th>Activation Date</th>
                        <th>Details Info</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $cl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cl->client_customer_name }}</td>
                            <td>{{ $cl->client_machine_id }}</td>
                            <td>
                                @if ($cl->client_machine_status != 'moved')

                                    <span class="badge badge-info">{{ $cl->client_machine_status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $cl->client_machine_status }}</span>
                                @endif
                            </td>
                            <td>{{ $cl->nama_cse }}</td>
                            <td>{{ $cl->product_name }}</td>
                            <td>{{ $cl->client_pic_name }}</td>
                            <td>{{ $cl->client_pic_hp }}</td>
                            <td>{{ $cl->client_site_location_name }}</td>
                            <td>{{ $cl->client_site_location_address }}</td>
                            <td>{{ $cl->client_activation_date }}</td>
                            <td>
                                <button onclick="edit('{{ $cl->cid }}')" class="btn btn-success float-right mr-2"><i
                                        class="fa fa-pencil-alt"></i></button>
                                <a onclick="return  confirm('are you sure?')" class="btn btn-danger float-right mr-2"
                                    href="{{ route('cl.delete', ['id' => $cl->cid]) }}"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" align="center">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Machine ID</th>
                        <th>Machine Status</th>
                        <th>CSE</th>
                        <th>Product</th>
                        <th>PIC Name</th>
                        <th>PIC No.HP</th>
                        <th>Site Location</th>
                        <th>Site Address</th>
                        <th>Activation Date</th>
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
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                    <label for="tbCustomerName" class="form-label">Customer name</label>
                                    <input required type="text" id="tbCustomerName" name="tbCustomerName"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Machine ID</label>
                                    <input required type="text" name="tbMachineId" id="tbMachineId" class="form-control ">
                                </div>
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <select required name="cbMachineStatus" id="cbMachineStatus"
                                        class="form-control select2">
                                        <option value="New Installation">New Installation</option>
                                        <option value="No Contract">No Contract</option>
                                        <option value="Rental">Rental</option>
                                        <option value="Maintenance & Part">Maintenance & Part</option>
                                        <option value="Maintenance Only">Maintenance Only</option>
                                        <option value="Part Only">Part Only</option>
                                        <option value="OnCall">OnCall</option>
                                        {{-- <option value="Warranty">Warranty</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>PIC Name</label>
                                    <input required type="text" name="tbPicName" id="tbPicName" class="form-control ">
                                </div>
                                <div class="col-md-6">
                                    <label>PIC No. HP</label>
                                    <input required type="text" name="tbPicHp" id="tbPicHp" class="form-control ">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Product Detail</label>
                                    <select required name="cbProduct" id="cbProduct" class="form-control select2">
                                        @forelse ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }} |
                                                {{ $product->brand_name }} | {{ $product->type_series }}</option>
                                        @empty
                                            <option>No Data</option>
                                        @endforelse
                                    </select>
                                    <small id="helpId" class="text-muted">type serial number to search</small><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>CS Engineer</label>
                                    <select required name="cbCse" id="cbCse" class="form-control select2">
                                        @forelse ($cse as $cs)
                                            <option value="{{ $cs->id }}">{{ $cs->nama_cse }}</option>
                                        @empty
                                            <option>No Data</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tbSiteLocation" class="form-label">Site Location</label>
                                    <input required type="text" id="tbSiteLocation" name="tbSiteLocation"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="tbSiteAddress" class="form-label">Site Address</label>
                                    <input required type="text" id="tbSiteAddress" name="tbSiteAddress"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="dtActivationDate" class="form-label">Activation Date</label>
                                    <input required type="date" id="dtActivationDate" name="dtActivationDate"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Warranty Duration</label>
                                    <select required name="cbWarranty" id="cbWarranty" class="form-control select2">
                                        <option value="none">none</option>
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="4 years">4 years</option>
                                        <option value="5 years">5 years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Operational Hours</label>
                                    <select required name="cbOperationalHours" id="cbOperationalHours"
                                        class="form-control select2">
                                        <option value="none">none</option>
                                        <option value="24 hours">24 hours</option>
                                        <option value="6am-19pm all days">6am-19pm all days</option>
                                        <option value="6am-19pm monday-friday">6am-19pm monday-friday</option>
                                        <option value="8am-21pm all days">8am-21pm all days</option>
                                        <option value="8am-21pm monday-friday">8am-21pm monday-friday</option>
                                        <option value="Lainnya">Lainnya</option>
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
    <!-- Select2 -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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

            // $('.jq-warranty').hide();


        });
    </script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })

        // $('#cb_machine_status').change(function(e) {
        //     e.preventDefault();
        //     if ($(this).val() == 'Warranty') {
        //         $('.jq-warranty').show();
        //     } else {
        //         $('.jq-warranty').hide();
        //     }
        // });

        function edit(id) {
            var url = '/client/edit/' + id;
            var link = '/client/update/' + id;
            $.ajax({
                url: url,
                method: 'get',
                success: function(response) {
                    $('#form-update').prop('action', link);
                    // machineStatus = response['client_machine_status'];
                    // cseId = response['customer_service_engineer_id'];
                    // productId = response['product_detail_id'];

                    $('#cbProduct').append(
                        `<option selected value="${response['product_detail_id']}">current : ${response['product_name']}</option>`
                    );
                    $('#cbCse').append(
                        `<option selected value="${response['customer_service_engineer_id']}">current : ${response['nama_cse']}</option>`
                    );
                    $('#tbCustomerName').val(response['client_customer_name']);
                    $('#tbMachineId').val(response['client_machine_id']);
                    $('#cbMachineStatus').append(
                        `<option selected value="${response['client_machine_status']}">current : ${response['client_machine_status']}</option>`
                    );
                    $('#tbPicName').val(response['client_pic_name']);
                    $('#tbPicHp').val(response['client_pic_hp']);
                    $('#tbSiteLocation').val(response['client_site_location_name']);
                    $('#tbSiteAddress').val(response['client_site_location_address']);
                    $('#dtActivationDate').val(response['client_activation_date']);
                    $('#cbWarranty').append(
                        `<option selected value="${response['client_warranty_year']}">current : ${response['client_warranty_year']}</option>`
                    );
                    $('#cbOperationalHours').append(
                        `<option selected value="${response['client_operation_hours']}">current : ${response['client_operation_hours']}</option>`
                    );
                    $('#update-modal').modal('show');
                }
            });
        }

        function closeModal() {
            $("#cbProduct option:contains('current : ')").remove();
            $("#cbCse option:contains('current : ')").remove();
            $("#cbMachineStatus option:contains('current : ')").remove();
            $("#cbWarranty option:contains('current : ')").remove();
            $("#cbOperationalHours option:contains('current : ')").remove();
            $('#update-modal').modal('hide');
            // $("#cbProduct option[value = productId]").remove();
        }

        ///fungsi get data client saat select berubah
        $('#cb_move_client').change(function(e) {
            e.preventDefault();
            console.log($(this).val());
            let id = $(this).val();
            let url = '/jobcard/getClientDataAjax/' + id;
            let link = '/client/relocate/' + id;
            $.ajax({
                url: url,
                method: "get",
                success: function(response) {
                    console.table(response);
                    $('#relocateButton').prop('href', link);
                }
            });
        });

        ///fungsi get data client saat laad
        function getClientToLink() {
            console.log($('#cb_move_client').val());
            let id = $('#cb_move_client').val();
            let url = '/jobcard/getClientDataAjax/' + id;
            let link = '/client/relocate/' + id;
            $.ajax({
                url: url,
                method: "get",
                success: function(response) {
                    console.table(response);
                    $('#relocateButton').prop('href', link);
                }
            });
        }

        $('#cb_product').change(function(e) {
            e.preventDefault();
            let product_id = $(this).val()
            const url = '/product/edit/' + product_id;
            $.ajax({
                type: "get",
                url: url,
                success: function(response) {
                    console.log(response);
                    $('#listProductInfo').html(`
                    <dd class="col-12">Product Info</dt>
                    <dt class="col-md-2 col-sm-4">Prod. Name :</dt>
                    <dd class="col-md-10 col-sm-8">${response.product_name}</dd>
                    <dt class="col-md-2 col-sm-4">Prod. Brand :</dt>
                    <dd class="col-md-10 col-sm-8">${response.brand_name}</dd>
                    <dt class="col-md-2 col-sm-4">Type Series :</dt>
                    <dd class="col-md-10 col-sm-8">${response.type_series}</dd>
                    <dt class="col-md-2 col-sm-4">Entry Date :</dt>
                    <dd class="col-md-10 col-sm-8">${response.date_of_entry}</dd>
                `)
                }
            });
        });

        getClientToLink();
    </script>
@endsection
