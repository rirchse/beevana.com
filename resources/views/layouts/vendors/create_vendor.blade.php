@extends('dashboard')
@section('title', 'Add New Vendor')
@section('content')
 <section class="content-header">
      <h1>Add Vendor</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Vendors</a></li>
        <li class="active">Add Vendor</li>
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
              <h3 style="color: #800" class="box-title">Vendor Information</h3>
            </div>
            {!! Form::open(['route' => 'vendor.store', 'method' => 'POST', 'files' => true]) !!}
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
                            {{Form::label('address', 'Address:', ['class' => 'control-label'])}}
                            {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 2]) !!}
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
                            {!! Form::textarea('details',null,['class'=>'form-control', 'rows' => 4, 'cols' => 45]) !!}
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
                </div>
                    <div class="clearfix"></div>
            {!! Form::close() !!}
          </div> <!-- /.box -->
        </div> <!--/.col (left) -->
      </div> <!-- /.row -->
    </section> <!-- /.content -->
@endsection