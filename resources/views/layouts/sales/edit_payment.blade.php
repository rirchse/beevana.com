@extends('dashboard')
@section('title', 'Create New New Payment')
@section('content')

{{-- {{dd($sale)}} --}}
<section class="content-header">
  <h1>Create New Payment</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> New Payments</a></li>
    <li class="active">Create New Payment</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-6"> <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 style="color: #800" class="box-title">New Payment Details</h3>
        </div>
        {!! Form::model($payment, ['route' => ['payment.update', $payment->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="box-body">
          
          <div class="form-group label-floating">
            {{ Form::label('paid_amount', 'Pay Amount:', ['class' => 'control-label']) }}
            {{ Form::text('paid_amount', null, ['class' => 'form-control', 'required' => ''])}}
          </div>
          <div class="form-group label-floating">
            {{ Form::label('details', 'Details', ['class' => 'control-label']) }}
            {!! Form::textarea('details',null,['class'=>'form-control', 'rows' => 4, 'cols' => 45]) !!}
          </div>
          

          <button type="submit" class="btn btn-primary pull-right">Save</button>
          <div class="clearfix"></div>
          {!! Form::close() !!}

        </div> <!-- /.box -->
      </div> <!--/.col (left) -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
  @endsection