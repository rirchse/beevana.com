@extends('dashboard')
@section('title', 'Add New Customer')
@section('content')
<section class="content-header">
  <h1>Add Customer</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
    <li class="active">Add Customer</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-10"><!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 style="color: #800" class="box-title">Customer Information</h3>
      </div>
      {!! Form::open(['route' => 'customer.store', 'method' => 'POST', 'files' => true]) !!}
      <div class="box-body">
        <div class="col-md-6">
            <h4>Personal Information:</h4>
            <div class="form-group label-floating">
                {{ Form::label('full_name', 'Full Name of Customer: *', ['class' => 'control-label']) }}
                {{ Form::text('full_name', null, ['class' => 'form-control', 'placeholder'=>'Customer Full Name'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('contact', 'Contact Number: *', ['class' => 'control-label']) }}
                {{ Form::text('contact', null, ['class' => 'form-control', 'placeholder'=>'Mobile Number'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('email', 'Email(Optional):', ['class' => 'control-label']) }}
                {{ Form::email('email', null, ['class' => 'form-control','placeholder'=>'Email Address'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('gender', 'Gender:', ['class' => 'control-label']) }}<br>
                {{Form::radio('gender', ' Male')}} Male &nbsp; &nbsp; 
                {{Form::radio('gender', 'Female')}} Female
            </div>
            <div class="form-group label-floating">
                {{ Form::label('care_of', 'Father\'s/Husband Name:', ['class' => 'control-label']) }}
                {{ Form::text('care_of', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('phone', 'Home Phone:', ['class' => 'control-label']) }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder'=>'Home Phone'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('date_of_birth', 'Date Of Barth:', ['class' => 'control-label']) }}
                {{ Form::date('date_of_birth', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('present_address', 'Present Address:', ['class' => 'control-label']) }}
                {{ Form::textarea('present_address', null, ['class' => 'form-control', 'placeholder'=>'Present Address', 'rows' => 2])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('permanent_address', 'Permanent Address: *', ['class' => 'control-label']) }}
                {{ Form::textarea('permanent_address', null, ['class' => 'form-control', 'placeholder'=>'Permanent Address', 'rows' => 2])}}
            </div>
        </div>
        <div class="col-md-6">
            <h4>Profession Information:</h4>
            <div class="form-group label-floating">
                {{ Form::label('profession', 'Profession:', ['class' => 'control-label']) }}
                {{ Form::text('profession', null, ['class' => 'form-control', 'placeholder'=>'Job Title'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('organization', 'Organization:', ['class' => 'control-label']) }}
                {{ Form::text('organization', null, ['class' => 'form-control', 'placeholder'=>'Organization'])}}
            </div>
        </div>
        <div class="col-md-6">
            <h4>Referral Information:</h4>
            <div class="form-group label-floating">
                {{ Form::label('referral', 'Referral Name: *', ['class' => 'control-label']) }}
                {{ Form::text('referral', null, ['class' => 'form-control', 'placeholder'=>'Referral Name']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('referral_contact', 'Referral Contact:', ['class' => 'control-label']) }}
                {{ Form::text('referral_contact', null, ['class' => 'form-control','placeholder'=>'Referral Contact']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('referral_address', 'Referral Address:', ['class' => 'control-label']) }}
                {{ Form::textarea('referral_address', null, ['class' => 'form-control', 'placeholder'=>'Referral Address', 'rows' => 2]) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('status', 'Status:', ['class' => 'control-label']) }}<br>
                Active: {!! Form::checkbox('status', 1); !!}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('image', 'Photo:', ['class' => 'control-label']) }}
                {{ Form::file('image', ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('details', 'Details', ['class' => 'control-label']) }}
                {!! Form::textarea('details', null, ['class'=>'form-control', 'rows' => 4, 'placeholder' => 'Details about this customer']) !!}
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
        </div>
      </div>
        {!! Form::close() !!}
    </div> <!-- /.box -->
</div> <!--/.col (left) -->
</div> <!-- /.row -->
</section> <!-- /.content -->
@endsection