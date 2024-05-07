@extends('dashboard')
@section('title', 'User Details')
@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Account Details</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{$user->user_role}}</a></li>
        <li class="active">User Details</li>
      </ol>
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="row"><!-- left column -->
      <div class="col-md-6"><!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title">Account Information</h4>
          </div>
          <div class="col-md-12 text-right toolbar-icon">
            <a href="{{route('user.index')}}" title="View {{Session::get('_types')}} users" class="label label-success"><i class="fa fa-list"></i></a>
            <a href="{{route('user.edit',$user->id)}}" class="label label-warning" title="Edit this User"><i class="fa fa-edit"></i></a>
            {{-- <a href="#" title="Print" class="label label-info"><i class="fa fa-print"></i></a> --}}
            
            {{-- <a href="{{route('user.delete',$user->id)}}" class="label label-danger" onclick="return confirm('Are you sure want to delete this account!');" title="Delete this account"><i class="fa fa-close"></i></a> --}}
            
          </div>
          <div class="col-md-12">
            <table class="table">
                <tbody>
                  <tr>
                    <th>User Permission:</th>
                    <td>{{$user_role->name}} [{{$user_role->description}}]</td>
                  </tr>
                  <tr>
                    <th>Name:</th>
                    <td>{{$user->name}}</td>
                  </tr>
                  
                  <tr>
                    <th>Email:</th>
                    <td>{{$user->email}}</td>
                  </tr>
                  <tr>
                    <th>Contact:</th>
                    <td>{{$user->contact}}</td>
                  </tr>              
                
                   <tr>
                    <th>Status:</th>
                    <td>
                      @if($user->status == 0)
                      <span class="label label-warning">Unverified</span>
                      @elseif($user->status == 1)
                      <span class="label label-success">Active</span>
                      @elseif($user->status == 2)
                      <span class="label label-danger">Disabled</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Record Created On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($user->created_at) )}} </td>
                  </tr>
                  <tr>
                    <th>Updated On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($user->updated_at) )}} </td>
                  </tr>
                  <tr>
                    <th>Photo:</th>
                    <td>
                      @if($user->image)
                      <a href="/img/user/{{$user->image}}" target="_blank" title="View large image"><img src="/img/user/{{$user->image}}" width=100 style="border: 5px solid #eee"></a>
                      @else
                      No image
                      @endif
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>

          <p><a href="{{route('user.delete',$user->id)}}" onclick="return confirm('Are sure you want to permanently delete this user?')" class="text-danger" style="padding:15px" title="Permanently Remove?"><i class="fa fa-remove"></i></a></p>
        </div>
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </section><!-- /.content -->
   
@endsection
