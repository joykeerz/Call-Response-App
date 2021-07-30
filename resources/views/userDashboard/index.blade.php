@extends('layouts.dashboard')

@section('title')
Yaksa Harmoni Global | Profile
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>User Profile and Settings</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
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

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Personal Info</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="icon text-center">
                            <i class="fas fa-user"></i>
                          </div>
                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                        <p class="text-muted text-center">Role : {{Auth::user()->level}}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>ID</b> <a class="float-right">{{Auth::user()->id}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                      @if (Auth::user()->level == 'admin')
                      <li class="nav-item"><a class="nav-link" href="#manageUsers" data-toggle="tab">Manage</a></li>
                      @endif
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="settings">
                        <form method="POST" action="{{ route('userProfile.Update', ['id' => Auth::user()->id]) }}" class="form-horizontal">
                            @csrf

                          <div class="form-group row">
                            <label for="tbname" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="tbname" name="tbname" placeholder="Name" value="{{Auth::user()->name}}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="tbemail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="tbemail" name="tbemail" placeholder="Email" value="{{Auth::user()->email}}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="tbpassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="tbpassword" name="tbpassword" placeholder="Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Update</button>
                              <input type="hidden" name="_method" value="PUT">
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->

                      <div class="tab-pane" id="manageUsers">
                          <div class="card">
                              <div style="background-color: rgb(250, 250, 250)" class="card-body">
                                  <h4>Users List<a href="#" onclick="insert()" class="float-right badge bg-info">Create New</a></h4>
                              </div>
                          </div>
                          <div class="card">
                              <div style="background-color: rgb(250, 250, 250)" class="card-body">
                                <ul class="nav flex-column">
                                    @forelse ($users as $user)
                                        <li class="nav-item mb-1">
                                            {{$user->name}}
                                            @if ($user->id != Auth::user()->id)
                                                <a onclick="return confirm('are you sure?')" href="{{route('userProfile.deleteUser',['id'=>$user->id])}}" class="btn badge float-right bg-danger">Delete</a>
                                                <a onclick="edit('{{$user->id}}')" class="btn badge float-right bg-primary">Edit</a>
                                            @else
                                            <a href="#" class="btn badge float-right bg-danger">You</a>
                                            @endif
                                        </li>
                                    @empty
                                        <li class="nav-item">
                                            No Data
                                        </li>
                                    @endforelse
                                  </ul>
                              </div>
                          </div>

                      </div>
                      <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
        </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            <button type="button" class="btn-close" onclick="closeModalEdit()" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            </div>
            <div class="modal-body">
                <form id="form-update" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbEditName" class="form-label">Name</label>
                            <input type="text" id="tbEditName" name="tbEditName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbEditEmail" class="form-label">Email</label>
                            <input type="text" id="tbEditEmail" name="tbEditEmail" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbEditPassword" class="form-label">Change Password</label>
                            <input type="text" id="tbEditPassword" name="tbEditPassword" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="cbEditRole" id="lblRole" class="form-label">Role : </label>
                            <select class="form-control" name="cbEditRole" id="cbEditRole">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
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
    <!-- Modal End -->

    <!-- Modal -->
    <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
            <button type="button" class="btn-close" onclick="closeModalInsert()" aria-label="Close">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route("userProfile.createUser")}}" id="form-insert" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbNewName" class="form-label">Name</label>
                            <input type="text" id="tbNewName" name="tbNewName" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbNewEmail" class="form-label">Email</label>
                            <input type="text" id="tbNewEmail" name="tbNewEmail" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tbNewPassword" class="form-label">Password</label>
                            <input type="text" id="tbNewPassword" name="tbNewPassword" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="cbNewRole" class="form-label">Role</label>
                            <select class="form-control" name="cbNewRole" id="cbNewRole">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
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
    <!-- Modal End -->

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
    function insert(){
        $('#insert-modal').modal('show');
    }
    function edit(id){
        var url = '/profile/manage/user/edit/'+id
        var link = '/profile/manage/user/update/'+id
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                $('#form-update').prop('action', link);
                $('#tbEditName').val(response['name']);
                $('#tbEditEmail').val(response['email']);
                $('#lblRole').html("Current : "+response['level']);
                $('#update-modal').modal('show');
            }
        });
    }

    function closeModalEdit(){
        $('#update-modal').modal('hide');
    }
    function closeModalInsert(){
        $('#insert-modal').modal('hide');
    }
</script>
@endsection
