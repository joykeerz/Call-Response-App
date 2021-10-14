@extends('layouts.dashboard')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Main Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
    <style>
        .svg-pattern-1 {
            background-color: #F4F6F9;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

    </style>
@endsection

@section('content')
    <div class="row">
    </div>
    <div class="card svg-pattern-1 ">
        <div class="card-header">
            <h1 class="card-title">Main Menu</h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body shadow-lg ">
            <div class="row">
                <div class="col-md-12">

                    <h3>Jobcard</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('backgrounds/pexels-cytonn-photography-955392.jpg') }}" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Jobcard Data</h4>
                                    <p class="card-text text-muted">Statistics and DataTable</p>
                                    <a href="{{ route('jobcard.index') }}"
                                        class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h3>Master Data</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('backgrounds/pexels-cytonn-photography-955388.jpg') }}" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Service Partner</h4>
                                    <p class="card-text text-muted">Manage Service Partners</p>
                                    <a href="{{ route('sp.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('backgrounds/pexels-fauxels-3183197.jpg') }}"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Bussiness Partner</h4>
                                    <p class="card-text text-muted">Manage Bussiness Partners</p>
                                    <a href="{{ route('bp.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('backgrounds/pexels-liliana-drew-8554372.jpg') }}" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Product Details</h4>
                                    <p class="card-text text-muted">Manage Products</p>
                                    <a href="{{ route('pd.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('backgrounds/pexels-cottonbro-7568447.jpg') }}"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Spareparts</h4>
                                    <p class="card-text text-muted">Manage Spareparts</p>
                                    <a href="{{ route('spp.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('backgrounds/austin-distel-wD1LRb9OeEo-unsplash.jpg') }}" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Client/Customer</h4>
                                    <p class="card-text text-muted">Manage Clients And Customers</p>
                                    <a href="{{ route('cl.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top"
                                    src="{{ asset('backgrounds/thisisengineering-raeng-SyRlD4s_amw-unsplash.jpg') }}"
                                    alt="">
                                <div class="card-body">
                                    <h4 class="card-title">CS Engineers</h4>
                                    <p class="card-text text-muted">Manage CS Engineers</p>
                                    <a href="{{ route('cse.index') }}" class="btn btn-outline-primary shadow-sm">Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
    </div> --}}
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
        });
    </script>
@endsection
