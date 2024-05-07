@extends('dashboard')
@section('title', 'View All Users')
@section('content')    

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Users Accounts</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        {{-- <li><a href="#">Tables</a></li> --}}
        <li class="active">Users Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of User Accounts</h3>
              {{-- <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Permission</th>
                    <th width="110">Action</th>
                  </tr>
                </thead>

                @foreach($users as $user)

                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->contact}}</td>
                  <td>
                    @if($user->status == 1)
                    <span class="label label-success">Verified</span>
                    @elseif($user->status == 0)
                    <span class="label label-warning">Unverified</span>
                    @elseif($user->status == 3)
                    <span class="label label-danger">Deleted</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($user->created_at))}}</td>
                  <td>{{ App\Role::leftJoin('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id', $user->id)->first()->name }}</td>
                  <td>
                    <a href="{{route('user.show',$user->id)}}" class="label label-info" title="User Details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('user.edit',$user->id)}}" class="label label-warning" title="Edit this User"><i class="fa fa-edit"></i></a>
                    @if($user->status == 1)
                    {{-- <a href="/admin/user_login/{{$user->email}}" class="label label-success" title="Login to this account" target="_blank"><i class="fa fa-search-plus"></i></a> --}}
                    @endif
                    @if($user->status == 0)
                    {{-- <a href="/admin/resend_email_verification/{{$user->id}}" class="label label-primary" onclick="return confirm('Are you sure you want to resend email verification to this user?')" title="Resend verification email."><i class="fa fa-envelope-o"></i></a> --}}
                    @endif
                    @if($user->status == 3)
                    <a href="/admin/user/{{$user->id}}/restore" class="label label-success" title="Restore the account" onclick="return confirm('Are you sure you want to restore the account?')"><i class="fa fa-undo"></i></a>
                    @endif
                  </td>
                </tr>

                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
                {{-- {{$users->links()}} --}}
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection
{{-- @section('scripts')
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
@endsection --}}