@extends('dashboard')
@section('title', 'Order Add to return')
@section('content')

{{-- {{dd($sale)}} --}}
<section class="content-header">
  <h1>Order Returned</h1>
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
        {!! Form::open(['route' => 'return.store', 'method' => 'POST', 'files' => true]) !!}
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
              <td>Total Amount: <b>{{$sale->gtotal}} tk</b></td>
            </tr>
          </table><br>
          {{Form::hidden('sales_id', $sale->id)}}
            <div class="form-group">
              {{ Form::label('comment', 'Comment:', ['class' => 'control-label']) }}
              {{ Form::textarea('comment', null, ['class' => 'form-control', 'required' => '', 'placeholder' => 'Why returned the order?', 'rows'=>3])}}
            </div>
            <div class="form-group">
              {{ Form::label('date', 'Return Date:', ['class' => 'control-label']) }}
              {!! Form::date('date', null, ['class'=>'form-control', 'required' => '']) !!}
            </div>
            <div class="form-group">
              {{ Form::label('delivery_man', 'Delivery Man (Optional):', ['class' => 'control-label']) }}
              {!! Form::text('delivery_man', null, ['class'=>'form-control', 'placeholder' => '(Optional)']) !!}
            </div>

          <button type="submit" class="btn btn-primary pull-right">Save</button>
          <div class="clearfix"></div>
          {!! Form::close() !!}

        </div> <!-- /.box -->
      </div> <!--/.col (left) -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
  @endsection