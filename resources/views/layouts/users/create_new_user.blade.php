@extends('dashboard')
@section('title', 'Create New Account')
@section('content')

 <section class="content-header">
      <h1>Create Account</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Create Account</li>
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
              <h3 style="color: #800" class="box-title">Account Details</h3>
            </div>
    {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="box-body">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    {{ Form::label('user_role', 'User Permission:', ['class' => 'control-label']) }}
                    <select name="user_role" class="form-control" required>
                        <option value="">Select Permission</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name.' ['.$role->description.']'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('name', 'Name:', ['class' => 'control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => ''])}}
                </div>
               
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address:', ['class' => 'control-label']) }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}
                </div>
                <div class="form-group label-floating">
                    {{ Form::label('contact', 'Contact No.', ['class' => 'control-label']) }}
                    {{ Form::text('contact', null, ['class' => 'form-control', 'minlength' => '11', 'maxlength' => '11', 'placeholder' => '01*********']) }}
                </div>
            </div>
           
        
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'required' => '']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => '']) }}
                </div>
            </div>

             <div class="col-md-12">

                <div class="form-group label-floating">
                    {{ Form::label('image', 'Add Photo', ['class' => 'control-label']) }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>
            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </div>
        
        <div class="clearfix"></div>
        {!! Form::close() !!}
          </div> <!-- /.box -->
        </div> <!--/.col (left) -->
      </div> <!-- /.row -->
    </section> <!-- /.content -->
@endsection