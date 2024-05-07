@extends('print')
@section('title', 'sale print')
@section('content')

  <?php 
  if($sale->customer_id){
    $customer = App\Customer::find($sale->customer_id);
  }
  ?>

<div style="font-size:15px;text-align:center; margin-bottom:10px">
  <input type="hidden" value="{{$sale->id}}" id="order_id">
  <a href="{{route('sale.show', $sale->id)}}" class="label label-info" title="Sale details"><i class="fa fa-file-text"></i></a>
  <a href="{{route('sale.index')}}" title="View sales" class="label label-success"><i class="fa fa-list"></i></a>
  <button href="#" title="Print" class="btn btn-info" onclick="document.title = '{{$customer->full_name.'_'.$sale->id}}'; printDiv();"><i class="fa fa-print"> Print</i></button>
</div>
<div id="table" style="background: #fff; max-width:148mm;margin:0 auto; padding: 15px; font-size:12px; border:1px solid #ddd;">
    {{-- <img src="/img/logo.png" class="img-responsive"> --}}
  <div>
      <table id="print" style="width:100%; border:0">
        <tr>
          <td>
            <img src="{{ asset('img/logo_print.png') }}" alt="" style="width: 120px;"><br>
            <b>BEEVANA.COM</b><br>
            218 Sahera Tropical Center 5th Floor(Lift-05), Suite-20, <br>Elephant Road, Bata Signal, Dhaka 1205<br>
            Contact: <b>016 34 666 999</b><br>
          </td>
          <td style="text-align:right">
            <div style="font-size:20px">INVOICE</div>
            <b># {{$sale->order_no}}</b><br>
            <small>
            <b>Date:</b> {{$sale->sales_date?date('d M Y',strtotime($sale->sales_date) ):''}}<br>
            <b>Payment Terms:</b> {!! $sale->payment_type?$sale->payment_type:'. . . . .'!!}<br>
            <h4 style="font-size:16px">Balance Due: <b>{{$sale->due}} tk</b></h4>
            </small>
          </td>
        </tr>
      </table>
  </div>
  <div style="padding:5px 0">
    <table style="width:100%">
      <tbody>
        <tr>
          <td>
            <b>Bill To:</b> &nbsp; &nbsp;{{$customer->full_name?$customer->full_name:''}}  &nbsp; &nbsp;
            Mobile: <b>{{$customer->contact?$customer->contact:''}}</b><br>
            <b>Address:</b> {{$sale->shipping_address??$customer->address}}
          </td>
        </tr>
      </tbody>
      </table>
      <table style="width:100%;border:1px solid; padding:5px">
        <h4 style="text-align:center;font-size:16px"><b>Ordered Items</b></h4>
        <tr style="background:#ddd">
          <th style="border: 1px solid #000; padding:5px">#</th>
          <th style="border: 1px solid #000; padding:5px">Product Name</th>
          <th style="border: 1px solid #000; padding:5px;width:70px;text-align:center">Price (tk)</th>
          <th style="border: 1px solid #000; padding:5px;width:60px" width=60>Quantity</th>
          <th style="border: 1px solid #000; padding:5px;width:90px" width=90>Total Price (tk)</th>
        </tr>
        @foreach(App\OrderItem::where('sales_id', $sale->id)->get() as $key => $item)
        <tr>
          <td style="border: 1px solid #000; padding:5px">{{$key+1}}</td>
          <td style="border: 1px solid #000; padding:5px">{{$item->name}}</td>
          <td style="border: 1px solid #000; padding:5px;text-align:center">{{$item->price}}</td>
          <td style="border: 1px solid #000; padding:5px;text-align:center">{{$item->qty}}</td>
          <td style="border: 1px solid #000; padding:5px;text-align:center">{{$item->total}}</td>
        </tr>
        @endforeach
      </table><br>
      <table style="width:100%">
        <tr>
          <td colspan=2 rowspan=6 style="width:300px;">
            <p><b>Note: </b> {{$sale->details}}</p><br>
          </td>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Sub-Total:&nbsp; &nbsp; {{$sale->sub_total}} tk</th>
        </tr>
        <tr>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Discount:&nbsp; &nbsp; {{$sale->discount}} tk</th>
        </tr>
        <tr>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Shipping:&nbsp; &nbsp; {{$sale->shipping}} tk</th>
        </tr>
        <tr>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Grand Total:&nbsp; &nbsp; {{$sale->gtotal}} tk</th>
        </tr>
        <tr>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Paid:&nbsp; &nbsp; {{$sale->paid}} tk</th>
        </tr>
        <tr>
          <th style="border:1px solid; padding:5px;text-align:right" colspan=3 class="text-right">Due:&nbsp; &nbsp; {{$sale->due}} tk</th>
        </tr>
      </table>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12" style="font-size:11px"><br><br>
      <b>Terms:</b><br>
    <b>01.</b> If Customer open the product in front of delivery man and want to return the product, must have to pay the delivery charge.<br>
    <b>02.</b> Any product would quality as a replacement if it meets any of the following conditions. Wrong product, size or color, Product lost in shipment, Products with major quality defects.<br>
    <b>03.</b> We have a 3 days easy replacement guarantee so In case of replacement you are request to make a complain with in 3 days from product receive date by Mobile, SMS, or Email and Send your product by "Sundarban Courer Service" to our office address with the number 01634666999 with must be it's original invoice. Original condition, Product tags.
    </div>
  <div class="clearfix"></div>
</div>

<script type="text/javascript">

//js print a div
  function printDiv() {
    var divToPrint = document.getElementById('table');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        '.pageheader{font-size:12px}'+
        'table { border-collapse:collapse; font-size:12px}' +
        'table th, table td { padding: 5px;}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();

    /* change printing status */
    var order_id = document.getElementById('order_id');
    $.ajax({
      'type': 'GET',
      'url': '/sale/print/'+order_id.value+'/change',
      success: function (data){
        console.log('working!');
      },
      error: function (data){
        console.log('Getting error!');
      }
    });
  }
</script>
@endsection