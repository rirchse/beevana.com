@extends('dashboard')
@section('title', 'User Details')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Payment {{$payment->product_id?App\Product::find($payment->product_id):''}} Details</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Details</li>
  </ol>    
</section>

<!-- Main content -->
<section class="content">
  <div class="row"><!-- left column -->
    <div class="col-md-9"><!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <div class="col-md-12 text-right toolbar-icon">
          <a href="{{route('payment.index')}}" title="View {{Session::get('_types')}} payments" class="label label-success"><i class="fa fa-list"></i></a>
          <a href="{{route('payment.edit',$payment->id)}}" class="label label-warning" title="Edit this payment"><i class="fa fa-edit"></i></a>
          {{-- <a href="{{route('payment.show',$payment->id)}}" title="Print" class="label label-info"><i class="fa fa-print"></i></a> --}}
          
          {{-- <a href="{{route('payment.delete',$payment->id)}}" class="label label-danger" onclick="return confirm('Are you sure want to delete this account!');" title="Delete this account"><i class="fa fa-close"></i></a> --}}
        </div>
        <div class="col-md-12">
          <table class="table">
            <tbody>
              <tr>
                <th>Payment Id:</th>
                <td>{{$payment->sales_id}}</td>
              </tr>
              <tr>
                <th>Paid Amount:</th>
                <td>{{$payment->paid_amount}}</td>
              </tr>
              <tr>
                <th>Payment Date:</th>
                <td>{{$payment->payment_date}}</td>
              </tr>
              <tr>
                <th>Received By:</th>
                <td>{{$payment->received_by}}</td>
              </tr>
                               
              <tr>
                <th>Deteils:</th>
                <td>{{$payment->details}}</td>
              </tr>
              <tr>
                <th>Status:</th>
                <td>
                  @if($payment->status == 0)
                  <span class="label label-warning">Unactive</span>
                  @elseif($payment->status == 1)
                  <span class="label label-success">Active</span>
                  @elseif($payment->status == 2)
                  <span class="label label-danger">Disabled</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Record Created On:</th>
                <td>{{date('d M Y h:i:s A',strtotime($payment->created_at) )}} </td>
              </tr>                 
            </tbody>
          </table>
        </div>
        <div class="clearfix"></div>
        <p><a href="{{route('payment.delete',$payment->id)}}" onclick="return confirm('Are sure you want to permanently delete this Payment?')" class="text-danger" style="padding:15px">Permanently Remove?</a></p>
      </div>
    </div><!-- /.box -->
  </div><!--/.col (left) -->
</section><!-- /.content -->

@endsection
