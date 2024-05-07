@extends('dashboard')
@section('title', 'Edit Order')
@section('content')

    <section class="content-header">
      <h1> Edit Order </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-11">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Order</h3>
            </div>
            <div class="col-md-12 text-right toolbar-icon">
              <a href="{{route('sale.show',$sale->id)}}" class="label label-info" title="sale Details"><i class="fa fa-file-text"></i></a>
              <a href="{{route('sale.index')}}" title="View {{Session::get('_types')}} sale" class="label label-success"><i class="fa fa-list"></i></a>
              {{-- <a href="{{route('sale.delete',$sale->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($sale, ['route' => ['sale.update', $sale->id], 'method' => 'PUT', 'files' => true]) !!}
              <div class="box-body">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('customer_name', 'Customer Name (*):', ['class' => 'control-label']) }}
                    {{ Form::text('customer_name', $sale->full_name, ['class' => 'form-control', 'placeholder' => 'Customer Full Name', 'required'=>''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('mobile', 'Mobile (*):', ['class' => 'control-label']) }}
                    {{ Form::text('mobile', $sale->contact, ['class' => 'form-control', 'min' => 11, 'placeholder' => 'Customer Mobile Number', 'required' => ''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('address', 'Address (*):', ['class' => 'control-label']) }}
                    {{ Form::textarea('address', $sale->address, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Customer Address', 'required' => ''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('email', 'Email Address (Optional):', ['class' => 'control-label']) }}
                    {{ Form::email('email', $sale->email, ['class' => 'form-control', 'placeholder'=>'Email Address (Optional)'])}}
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:0">
                    <div class="form-group">
                        {{ Form::label('order_no', 'Order Number:', ['class' => 'control-label']) }}
                        {{ Form::text('order_no', $sale->order_no, ['class' => 'form-control', 'required' => '', 'placeholder' => 'example: 10000'])}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:0">
                    <div class="form-group">
                        {{ Form::label('sales_date', 'Sales Date:', ['class' => 'control-label']) }}
                        {{ Form::date('sales_date', date('Y-m-d', strtotime($sale->sales_date)), ['class' => 'form-control', 'required' => '','placeholder'=>'Sale Date'])}}
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="items" class="table table-bordered table-stripped">
                                <tr>
                                    <th>Product Name</th>
                                    <th width=100>Unit Price</th>
                                    <th width=70>Qty</th>
                                    <th width=120>Total</th>
                                    <th width=60>Action</th>
                                </tr>
                        </div>
                        @foreach(App\OrderItem::where('sales_id', $sale->id)->get() as $item)
                        <tr>
                            <td>
                                <input type="hidden" name="itemId[]" value="{{$item->id}}">
                                <input name="itemname[]" type="text" class="form-control" required="" value="{{$item->name}}">
                            </td>
                            <td>
                                <input name="price[]" type="text" class="form-control" value="{{$item->price}}">
                            </td>
                            <td>
                                <input name="qty[]" type="number" class="form-control" onchange="calcTotal(this)" min="1" value="{{$item->qty}}">
                            </td>
                            <td>
                                <input name="total[]" type="text" class="form-control itemTotal" value="{{$item->total}}">
                            </td>
                            <td>
                                <span class="btn btn-danger btn-sm" onclick="removetr(this)"><i class="fa fa-close"></i></span>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                        {{-- <div class="col-md-6 col-sm-6"> --}}
                            <button id="add_item" type="button" class="btn btn-info btn-sm" id="item" title=" Add Item"><i class="fa fa-plus"> </i> Add Item</button>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 pull-right" style="padding-right:0; padding-left:30px">
                    <br>
                    <style type="text/css">
                    .calc-table th, .calc-table td{padding: 5px!important}
                    </style>
                    <div class="table-responsive">
                    <table class="table table-bordered table-stripped text-right calc-table">
                        <tr>
                            <td>Sub-Total (tk): </td>
                            <th>
                                {{ Form::text('sub_total', $sale->sub_total, ['class'=>'form-control', 'id' => 'sub_total', 'style' => 'max-width:100px', 'required' => '']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Discount (tk): </td>
                            <th>
                                {{ Form::text('discount', $sale->discount, ['class'=>'form-control', 'id' => 'discount', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Shipping (tk): </td>
                            <th>
                                {{ Form::text('shipping', $sale->shipping, ['class'=>'form-control', 'id' => 'shipping', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Grand Total (tk): </td>
                            <th>
                                {{ Form::text('gtotal', $sale->gtotal, ['class'=>'form-control', 'id' => 'gtotal', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Paid (tk): </td>
                            <th>
                                {{ Form::text('paid', $sale->paid, ['class'=>'form-control', 'id' => 'paid', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Due (tk): </td>
                            <th>
                                {{ Form::text('due', $sale->due, ['class'=>'form-control', 'id' => 'due', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                    </table>
                </div>
                </div>
                <div class="col-md-7 col-sm-6 no-padding pull-left">
                    <div class="clearfix"></div>
                    <br>
                    <div class="form-group">
                        {{ Form::label('shipping_address', 'Shipping Address:', ['class' => 'control-label']) }}
                        {!! Form::textarea('shipping_address', null, ['class'=>'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('note', 'Note:', ['class' => 'control-label']) }}
                        {!! Form::textarea('note', $sale->details, ['class'=>'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
                    </div>

                    <style type="text/css">
                    .ul-status{width: 100%;padding-left: 0}
                    .ul-status li{display: inline-block; padding-right: 20px}
                    </style>

                    <div class="form-group"><br>
                        {{ Form::label('status', 'Status: ', ['class' => 'control-label']) }}
                        <ul class="ul-status">
                            <li class="radio">
                                <label class="text-primary"><input type="radio" name="status" {{$sale->status == 0?'checked':''}} value="0">New Order</label>
                            </li>
                            <li class="radio">
                                <label class="text-warning"><input type="radio" name="status" {{$sale->status == 1?'checked':''}} value="1">Confirmed</label>
                            </li>
                            <li class="radio">
                                <label class="text-success"><input type="radio" name="status" {{$sale->status == 2?'checked':''}} value="2">Completed</label>
                            </li>
                            <li class="radio">
                                <label class="text-danger"><input type="radio" name="status" {{$sale->status == 3?'checked':''}} value="3">Cancelled</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"> </i> Save</button>
            </div>
            </div> <!-- /.box body -->
            {!! Form::close() !!}

        </div> <!--/.col (left) -->
      </div> <!-- /.row -->
    </section> <!-- /.content -->

    <script type="text/javascript">
    var total_price = 0;

    var add_item   = document.getElementById('add_item');
    var items  = document.getElementById('items');
    var sub_total = document.getElementById('sub_total');
    var discount = document.getElementById('discount');

    add_item.addEventListener('click', addRow);
    function addRow(){

        //add table row/tr and cell/td
        var row     = items.insertRow(-1);
        var name    = row.insertCell(0);
        var price   = row.insertCell(1);
        var qty     = row.insertCell(2);
        var Total   = row.insertCell(3);
        var action  = row.insertCell(4);

        //add item id
        var itemid   = document.createElement('input');
        itemid.name  = "itemId[]";
        itemid.type  = "hidden";
        itemid.value = "";
        name.appendChild(itemid);

        //add item name
        var itemname   = document.createElement('input');
        itemname.name  = "itemname[]";
        itemname.type  = "text";
        itemname.value = "";
        itemname.setAttribute('class', 'form-control');
        itemname.setAttribute('required', '');
        name.appendChild(itemname);

        //add item price
        var itemPrice   = document.createElement('input');
        itemPrice.name  = "price[]";
        itemPrice.type  = "text";
        itemPrice.setAttribute('class', 'form-control');
        itemPrice.value = "";
        price.appendChild(itemPrice);

        //add item qty
        var itemQty   = document.createElement('input');
        itemQty.name  = "qty[]";
        itemQty.type  = "number";
        itemQty.setAttribute('class', 'form-control');
        itemQty.setAttribute('onchange', 'calcTotal(this)');
        itemQty.setAttribute('min', 1);
        itemQty.value = 0;
        qty.appendChild(itemQty);

        //add item qty
        var itemTotal   = document.createElement('input');
        itemTotal.name  = "total[]";
        itemTotal.type  = "text";
        itemTotal.setAttribute('class', 'form-control itemTotal');
        itemTotal.value = 0;
        Total.appendChild(itemTotal);

        var actbtn = document.createElement('span');
        actbtn.setAttribute('class', 'btn btn-danger btn-sm');
        actbtn.setAttribute('onclick', 'removetr(this)');
        actbtn.innerHTML = '<i class="fa fa-close"></i>';
        action.appendChild(actbtn);
    }

    // remove table row on click close sign
    function removetr(o) {

        // console.log(o.parentElement.previousElementSibling.firstElementChild.value);
        sub_total.value = sub_total.value - o.parentElement.previousElementSibling.firstElementChild.value;

        Discount();
        Shipping();
        dueCalc();

        var p = o.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }

    var due = document.getElementById('due');
    var grand_total = document.getElementById('gtotal');
    var paid = document.getElementById('paid');
    var shipping = document.getElementById('shipping');

    discount.addEventListener('keyup', Discount);
    function Discount(){
        grand_total.value = (sub_total.value - discount.value) + Number(shipping.value);
        dueCalc();
    }

    shipping.addEventListener('keyup', Shipping);
    function Shipping(){
        grand_total.value = (sub_total.value - discount.value) + Number(shipping.value);
        dueCalc();
    }

    paid.addEventListener('keyup', dueCalc);
    function dueCalc(){
        due.value = grand_total.value - paid.value;
    }

    //change total change by qty
    var quantity = document.getElementsByName('qty');
    // console.log(quantity);

    function calcTotal(e){
        e.parentElement.nextElementSibling.firstElementChild.value = e.parentElement.previousElementSibling.firstElementChild.value * e.value;

        var Totals = document.getElementsByClassName('itemTotal');
        var gtotal = 0;
        for(var i = 0; Totals.length > i; i++){
            gtotal += Number(Totals[i].value);
        }

        sub_total.value = parseFloat(gtotal).toFixed(2);
        Discount();
        Shipping();
        dueCalc();
    }
    </script>
@endsection