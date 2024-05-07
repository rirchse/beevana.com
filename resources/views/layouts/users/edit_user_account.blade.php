@extends('dashboard')
@section('title', 'Edit User Account')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>User Account</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit User Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User Account <b>[{{$user_role->description}}]</b></h3>
            </div>
            <div class="col-md-12 text-right toolbar-icon">
              <a href="{{route('user.show',$user->id)}}" class="label label-info" title="User Details"><i class="fa fa-file-text"></i></a>
              <a href="{{route('user.index')}}" title="View {{Session::get('_types')}} users" class="label label-success"><i class="fa fa-list"></i></a>
              {{-- <a href="{{route('user.delete',$user->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
              <div class="box-body">
                <div class="form-group label-floating">
                    {{ Form::label('user_role', 'User Permission:', ['class' => 'control-label']) }}
                    <select name="user_role" class="form-control">
                        <option value="">Select Permission</option>
                        <option selected value="{{$user_role->id}}">{{$user_role->name.'['.$user_role->description.']'}}</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name.' ['.$role->description.']'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                  {{ Form::label('name', 'Name:', ['class' => 'control-label']) }}
                  {{ Form::text('name', $user->name, ['class' => 'form-control'])}}
                </div>
                
                <div class="form-group">
                  {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                  {{ Form::email('email', $user->email, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  {{ Form::label('contact', 'Contact Number:', ['class' => 'control-label']) }}
                  {{ Form::text('contact', $user->contact, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                  <label for="image">Profile Image</label>
                  <input class="form-control" type="file" id="image" name="image">
                </div>
                <div class="checkbox"><b>Status: &nbsp; </b>
                  <label><input type="checkbox" name="status" value="1" {{$user->status == 1? 'checked': ''}}> Active</label>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
              </div>
            {!! Form::close() !!}
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection