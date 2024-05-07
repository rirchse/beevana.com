@extends('dashboard')
@section('title', 'View All Payment')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{$type != ''?$type:'All'}} Payments</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        {{-- <li><a href="#">Tables</a></li> --}}
        <li class="active">All Payments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Payment</h3>
              <div class="box-tools">
                <style type="text/css">
                .payment_item{padding: 5px 10px;border:1px solid #ddd;display: inline-block;}
                </style>
                <div class="input-group input-group-sm">
                  <a class="payment_item" href="/payment/All/view">All</a>
                  <a class="payment_item" href="/payment/bKash/view">bKash</a>
                  <a class="payment_item" href="/payment/Rocket/view">Rocket</a>
                  <a class="payment_item" href="/payment/Nagad/view">Nagad</a>
                  <a class="payment_item" href="/payment/Cash/view">Cash</a>
                </div>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>Id</th>
                  <th>#Order</th>
                  <th>Customer Name</th>
                  <th>Mobile Number</th>
                  <th>Grand Total (tk)</th>
                  <th>Due (tk)</th>
                  <th>Paid (tk)</th>
                  <th>Balance (tk)</th>
                  <th>Date</th>
                  <th>Payment Type</th>
                  <th width="70">Action</th>
                </tr>

                <?php $balance = 0; ?>

                @foreach($payments as $payment)
                <?php $balance += $payment->paid_amount;?>

                <tr>
                  <td>{{$payment->id}}</td>
                  <td>#{{$payment->order_number}}</td>
                  <td>{{$payment->full_name}}</td>
                  <td>{{$payment->contact}}</td>
                  <td>{{$payment->gtotal}}</td>
                  <td>{{$payment->due}}</td>
                  <td>{{$payment->paid_amount}}</td>
                  <td>{{$balance}}</td>
                  <td>{{date('d M Y', strtotime($payment->payment_date))}}</td>
                  <td>{{$payment->payment_type}}</td>
                  <td>
                    <a href="/payment/{{$payment->id}}" class="label label-info" title="Payment Details"><i class="fa fa-file-text"></i></a>
                    {{-- <a href="{{route('payment.edit',$payment->id)}}" class="label label-warning" title="Edit this payment"><i class="fa fa-edit"></i></a> --}}

                    @if(Auth::user()->authorizeRoles(['SuperAdmin', 'Admin']))
                    <a href="{{route('payment.delete', $payment->id)}}" class="label label-danger" onclick="return confirm('Are you sure you want to delete this item!');" title="Delete this item"><i class="fa fa-trash"></i></a>
                    @endif

                  </td>
                </tr>

                @endforeach
              </table>
            </div> <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
              </div>
            </div>
          </div> <!-- /.box -->
        </div>
      </div>
    </section> <!-- /.content -->
@endsection
