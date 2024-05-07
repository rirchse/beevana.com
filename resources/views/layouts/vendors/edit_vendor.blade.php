@extends('dashboard')
@section('title', 'Edit Vendor Account')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Vendor Account</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit vendor Account</li>
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
              <h3 class="box-title">Edit vendor Account</h3>
            </div>
            <div class="col-md-12 text-right toolbar-icon">
              <a href="{{route('vendor.show',$vendor->id)}}" class="label label-info" title="vendor Details"><i class="fa fa-file-text"></i></a>
              <a href="{{route('vendor.index')}}" title="View {{Session::get('_types')}} vendors" class="label label-success"><i class="fa fa-list"></i></a>
              {{-- <a href="{{route('vendor.delete',$vendor->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($vendor, ['route' => ['vendor.update', $vendor->id], 'method' => 'PUT', 'files' => true]) !!}
              <div class="box-body">
                    <div class="col-md-12">
                        
                        <div class="form-group label-floating">
                            {!! html_entity_decode( Form::label('name', 'Name: <span class="text-danger">*</span>', ['class' => 'control-label']) )!!}
                            {{ Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group label-floating">
                            {!! html_entity_decode( Form::label('business_name', 'Business Name: <span class="text-danger">*</span>', ['class' => 'control-label']) )!!}
                            {{ Form::text('business_name', null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group label-floating">
                            {!! html_entity_decode( Form::label('address', 'Address:', ['class' => 'control-label']) )!!}
                            {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 1]) !!}
                        </div>
                       
                        <div class="form-group label-floating">
                            {{ Form::label('email', 'Email Address: (Optional)', ['class' => 'control-label']) }}
                            {{ Form::email('email', null, ['class' => 'form-control']) }}
                        </div>
                        
                        <div class="form-group label-floating">
                            {!! html_entity_decode( Form::label('contact', 'Contact No: <span class="text-danger">*</span>', ['class' => 'control-label']) )!!}
                            {{ Form::text('contact', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group label-floating">
                            {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                            {!! Form::textarea('details',null,['class'=>'form-control', 'rows' => 2]) !!}
                        </div>
                    <div class="form-group label-floating">
                        <b>Status:</b> <br>
                        {{ Form::label('status', 'Active:', ['class' => 'control-label']) }}
                        {!! Form::checkbox('status', '1','checked'); !!}
                    </div>
                    <div class="form-group label-floating">
                        {{ Form::label('image', 'Image:', ['class' => 'control-label']) }}
                        {{ Form::file('image') }}
                    </div>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
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