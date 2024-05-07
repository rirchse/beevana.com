@extends('dashboard')
@section('title', 'Add Customer Payment')
@section('content')

{{-- {{dd($sale)}} --}}
<section class="content-header">
  <h1>Add Customer Payment</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Customer Payments</a></li>
    <li class="active">Add Customer Payment</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-6"> <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 style="color: #800" class="box-title">Order Details <b> [ #{{$sale->id}} ]</b></h3>
        </div>
        {!! Form::open(['route' => 'payment.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="box-body">
          <table class="table border" style="border:1px solid #ddd">
            <tr>
              <td>Customer Name: <b>{{$sale->full_name}}</b></td>
            </tr>
            <tr>
              <td>Contact Number: <b>{{$sale->contact}}</b></td>
            </tr>
            <tr>
              <td>Order Number: <b> #{{$sale->id}}</b></td>
            </tr>
            <tr>
              <td>Grand Total: <b>{{$sale->gtotal}} tk</b> &nbsp; &nbsp;  Paid: <b>{{$sale->paid}} tk</b>  &nbsp; &nbsp; Due Amount: <b>{{$sale->due}} tk</b></td>
            </tr>
          </table><br>
          {{Form::hidden('sales_id', $sale->id)}}
            <div class="form-group">
              {{ Form::label('paid_amount', 'Paid Amount:', ['class' => 'control-label']) }}
              {{ Form::text('paid_amount', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '00.00 tk'])}}
            </div>
            <div class="form-group">
              {{ Form::label('payment_type', 'Payment Type:', ['class' => 'control-label']) }}
              {{ Form::select('payment_type', ['' => '', 'bKash' => 'bKash', ' Rocket' => 'Rocket', 'Nagad' => 'Nagad', 'Cash' => 'Cash', 'Bank' => 'Bank', 'Others' => 'Others'], null, ['class' => 'form-control', 'required' => ''])}}
            </div>
            <div class="form-group">
              {{ Form::label('date', 'Payment Date:', ['class' => 'control-label']) }}
              {!! Form::date('date', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {{ Form::label('note', 'Note:', ['class' => 'control-label']) }}
              {!! Form::textarea('note', null,['class'=>'form-control', 'rows' => 2]) !!}
            </div>

          <button type="submit" class="btn btn-primary pull-right">Save</button>
          <div class="clearfix"></div>
          {!! Form::close() !!}

        </div> <!-- /.box -->
      </div> <!--/.col (left) -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
  @endsection