@extends('dashboard')
@section('title', 'Sale Details')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Sale Details</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Sales</a></li>
    <li class="active">Details</li>
  </ol>    
</section>

<!-- Main content -->
<section class="content">
  <div class="row"><!-- row -->
    <div class="col-md-7"><!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border"> <h3 style="color: #800" class="box-title">Sales Information <b>[Order Number #{{$sale->order_no}}]</b></h3></div>
        <div class="col-md-12 text-right toolbar-icon">

          @if(Auth::user()->authorizeRoles(['SuperAdmin', 'Admin']))
          <a href="/payment/{{$sale->id}}/get" title="Add Payment" class="label label-info"><i class="fa fa-plus"></i></a>
            @if(!count(App\OrderReturn::where('sales_id', $sale->id)->get()) && $sale->status == 3)
            <a href="/return/{{$sale->id}}/order" title="Order Add to Return" class="label label-danger"><i class="fa fa-undo"></i></a>
            @endif
          @endif

          <a href="{{route('sale.index')}}" title="View sales" class="label label-success"><i class="fa fa-list"></i></a>
          <a href="{{route('sale.edit',$sale->id)}}" class="label label-warning" title="Edit this sale"><i class="fa fa-edit"></i></a>
          {{-- <a href="{{route('index.payment',$sale->id)}}" title="Print" class="label label-success"><i class="fa fa-money"></i></a> --}}
          <a href="/sale/{{$sale->id}}/print" title="Print" class="label label-info"><i class="fa fa-print"></i></a>
          
          @if(Auth::user()->authorizeRoles(['SuperAdmin', 'Admin']))
          <a href="{{route('sale.delete',$sale->id)}}" class="label label-danger" onclick="return confirm('Are you sure you want to delete this item!');" title="Delete this item"><i class="fa fa-trash"></i></a>
          @endif
        </div>
        <div class="col-md-12">
          <table class="table">
            <tbody>
              <?php 
              if($sale->customer_id){
                $customer = App\Customer::find($sale->customer_id);
              }
              ?>
              <tr>
                <th>Customer Name:</th>
                <td>{{$customer->full_name?$customer->full_name:''}}</td>
              </tr>
              <tr>
                <th>Mobile Number:</th>
                <td>{{$customer->contact?$customer->contact:''}}</td>
              </tr>
              <tr>
                <th>Address:</th>
                <td>{{$customer->address?$customer->address:''}}</td>
              </tr>
              <tr>
                <th>Shipping Address:</th>
                <td>{{$sale->shipping_address}}</td>
              </tr>
              <tr>
                <th>Sales Date:</th>
                <td>{{$sale->sales_date?date('d M Y',strtotime($sale->sales_date) ):''}} </td>
              </tr>
              {{-- <tr>
                <th>Payment Type:</th>
                <td>{{$sale->payment_type}}</td>
              </tr> --}}
              <tr>
                <th>Note:</th>
                <td>{{$sale->details}}</td>
              </tr>
              <tr>
                <th>Status:</th>
                <td>
                  @if($sale->status == 0)
                  <span class="label label-info">Pending Order</span>
                  @elseif($sale->status == 1)
                  <span class="label label-warning">Confirmed</span>
                  @elseif($sale->status == 2)
                  <span class="label label-success">Completed</span>
                  @elseif($sale->status == 3)
                  <span class="label label-danger">Cancelled</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Printing Status:</th>
                <th>{{$sale->print_status?'Printed ['.$sale->print_status.']':''}}</th>
              </tr>
              <tr>
                <th>Record Created On:</th>
                <td>{{date('d M Y h:i:s A',strtotime($sale->created_at) )}} </td>
              </tr>                 
            </tbody>
          </table>
          <table class="table">
            <h4 class="text-center">Ordered Items</h4>
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th width=100 style="text-align:right">Total Price</th>
            </tr>
            @foreach(App\OrderItem::where('sales_id', $sale->id)->get() as $key => $item)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->price}}</td>
              <td>{{$item->qty}}</td>
              <td style="text-align:right">{{$item->total}}</td>
            </tr>
            @endforeach
          </table>
          <table class="table table-bordered pull-right"style="width:200px">
            <tr>
              <th style="text-align:right">Sub-Total: &nbsp; {{$sale->sub_total}} tk</th>
            </tr>
            <tr>
              <th  style="text-align:right">Discount: &nbsp; {{$sale->discount?$sale->discount:0}} tk</th>
            </tr>
            <tr>
              <th style="text-align:right">Shipping: &nbsp; {{$sale->shipping?$sale->shipping:0}} tk</th>
            </tr>
            <tr>
              <th style="text-align:right">Grand Total: &nbsp; {{$sale->gtotal}} tk</th>
            </tr>
            <tr>
              <th style="text-align:right">Paid: &nbsp; {{$sale->paid?$sale->paid:0}} tk</th>
            </tr>
            <tr>
              <th style="text-align:right">Due: &nbsp; {{$sale->due?$sale->due:0}} tk</th>
            </tr>
          </table>
        </div>
        <div class="clearfix"></div>
      </div><!-- /.box -->
    </div><!--/.col (left) -->


    <div class="col-md-5">
      <div class="box box-primary">
        <div class="box-header with-border"><h3 style="color: #800" class="box-title">Payment History <b>[Order Number #{{$sale->order_no}}]</b></h3>
        </div>
      <table class="table">
        <tr>
          <th>Payment Date</th>
          <th>Amount</th>
          <th>Payment Type</th>
        </tr>
        <?php $total_paid =0; ?>
        @foreach(App\Payment::where('sales_id', $sale->id)->get() as $payment)
        <?php $total_paid += $payment->paid_amount; ?>
          <tr>
            <td>{{date('d M Y', strtotime($payment->payment_date))}}</td>
            <td>{{$payment->paid_amount}} tk</td>
            <td>{{$payment->payment_type}}</td>
          </tr>
        @endforeach
        <tr>
          <td colspan=3>Total Paid: <b>{{$total_paid}}</b> tk</td>
        </tr>
      </table>
    </div>
    </div>
  </div><!-- /.row -->
</section><!-- /.content -->

@endsection
