@extends('dashboard')
@section('title', 'Place An Order')
@section('content')
<section class="content-header">
  <h1>Place An Order</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
    <li class="active">Place An Order</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-12"> <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #800" class="box-title">Order Information</h3>
        </div>
          {!! Form::open(['route' => 'sale.store', 'method' => 'POST', 'files' => true]) !!}
          <div class="box-body">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('customer_name', 'Customer Name (*):', ['class' => 'control-label']) }}
                    {{ Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Customer Full Name', 'required'=>''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('mobile', 'Mobile (*):', ['class' => 'control-label']) }}
                    {{ Form::text('mobile', null, ['class' => 'form-control', 'min' => 11, 'placeholder' => 'Customer Mobile Number', 'required' => '', 'autofocus' => ''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    {{ Form::label('address', 'Address (*):', ['class' => 'control-label']) }}
                    {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Customer Address', 'required' => ''])}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('email', 'Email Address (Optional):', ['class' => 'control-label']) }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder'=>'Email Address (Optional)'])}}
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:0">
                    <div class="form-group">
                        {{ Form::label('order_no', 'Order Number:', ['class' => 'control-label']) }}
                        {{ Form::text('order_no', null, ['class' => 'form-control', 'required' => '', 'placeholder' => 'Only Numbers'])}}
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:0">
                    <div class="form-group">
                        {{ Form::label('sales_date', 'Sales Date:', ['class' => 'control-label']) }}
                        {{ Form::date('sales_date', date('Y-m-d'), ['class' => 'form-control', 'required' => '','placeholder'=>'Sale Date'])}}
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
                                <td><input name="itemname[]" type="text" class="form-control" required="" onkeyup="getItemName(this)"></td>
                                <td><input name="price[]" type="text" class="form-control"></td>
                                <td><input name="qty[]" type="number" class="form-control" onchange="calcTotal(this)" min="1" value=0></td>
                                <td><input name="total[]" type="text" class="form-control itemTotal" value=0></td>
                                <td><span class="btn btn-danger btn-sm" onclick="removetr(this)"><i class="fa fa-close"></i></span></td>
                            </table>
                        </div>
                        {{-- <div class="col-md-6 col-sm-6"> --}}
                            <button id="add_item" type="button" class="btn btn-info btn-sm" id="item" title=" Add Item"><i class="fa fa-plus"> </i> Add Item</button>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 pull-right" style="padding-right:0; padding-left:30px">
                    <style type="text/css">
                    .calc-table th, .calc-table td{padding: 5px!important}
                    </style>
                    <div class="table-responsive">
                    <table class="table table-bordered table-stripped text-right calc-table">
                        <tr>
                            <td>Sub-Total (tk): </td>
                            <th>
                                {{ Form::text('sub_total', 0, ['class'=>'form-control', 'id' => 'sub_total', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Discount (tk): </td>
                            <th>
                                {{ Form::text('discount', 0, ['class'=>'form-control', 'id' => 'discount', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Shipping (tk): </td>
                            <th>
                                {{ Form::text('shipping', 0, ['class'=>'form-control', 'id' => 'shipping', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Grand Total (tk): </td>
                            <th>
                                {{ Form::text('gtotal', 0, ['class'=>'form-control', 'id' => 'gtotal', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Paid (tk): </td>
                            <th>
                                {{ Form::text('paid', 0, ['class'=>'form-control', 'id' => 'paid', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                        <tr>
                            <td>Due (tk): </td>
                            <th>
                                {{ Form::text('due', 0, ['class'=>'form-control', 'id' => 'due', 'style' => 'max-width:100px']) }}
                            </th>
                        </tr>
                    </table>
                </div>
                </div>
                <div class="col-md-7 col-sm-6 no-padding pull-left">
                    <div class="clearfix"></div>
                    <div class="form-group">
                        {{ Form::label('shipping_address', 'Shipping Address:', ['class' => 'control-label']) }}
                        {!! Form::textarea('shipping_address', null, ['class'=>'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('note', 'Note:', ['class' => 'control-label']) }}
                        {!! Form::textarea('note', null, ['class'=>'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
                    </div>

                    <style type="text/css">
                    .ul-status{width: 100%;padding-left: 0}
                    .ul-status li{display: inline-block; padding-right: 20px}
                    </style>

                    <div class="form-group">
                        {{ Form::label('status', 'Status: ', ['class' => 'control-label']) }}
                        <ul class="ul-status">
                            <li class="radio">
                                <label class="text-primary"><input type="radio" name="status" value="0">Pending Order</label>
                            </li>
                            <li class="radio">
                                <label class="text-warning"><input type="radio" name="status" value="1">Confirmed</label>
                            </li>
                            <li class="radio">
                                <label class="text-success"><input type="radio" name="status" value="2">Completed</label>
                            </li>
                            <li class="radio">
                                <label class="text-danger"><input type="radio" name="status" value="3">Cancelled</label>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"> </i> Save</button>
            </div>
            </div> <!-- /.box body -->
            <!-- datalist -->
            <datalist id="itemnames">
                <option value="aaaaaa">
                <option value="bbbbb">
                <option value="cccccc">
            </datalist>
            {!! Form::close() !!}
          </div> <!-- /.box -->
      </div> <!--/.col-12 -->
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

        sub_total.value = gtotal;
        Discount();
        Shipping();
        dueCalc();
    }

    /** ----------------------------- Search Customer by ajax --------------- **/
    var mobile = document.getElementById('mobile');
    var search_customer = document.getElementById('search_customer');
    mobile.addEventListener('keyup', getCustomer);

    function getCustomer(elm){
        var customer_name = document.getElementById('customer_name');
        var address = document.getElementById('address');

        if(mobile.value.length != 11){
            customer_name.value = "";
            address.value = "";
            return false;
        }

        // console.log(mobile);

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/search/customer/'+mobile.value,
            success: function (data) {
                var obj = JSON.parse(JSON.stringify(data));
                // console.log(obj['success']);
                if(obj['success'] == null){
                    alert('Customer not found. Please create a new customer.');
                    return false;
                }

                var customer = obj['success'];

                customer_name.value = customer['full_name'];
                address.value = customer['address'];
            },
            error: function(data) { 
                 alert('Could not retrive data from database!');
            }
        });
    }

    //** ---------------------- customer serch end ----------------------- **//
    //** ------------- search product by ajax and make datalist ---------- **//
    function getItemName(elm){
        $.ajax({
            type: 'GET',
            url: '/search_item_names',
            success: function (data){
                var names = '';
                // var itemnames = document.getElementById('itemnames');

                var obj = JSON.parse(JSON.stringify(data));
                $.each(obj['success'], function (key, val){
                    names += '<option value="'+val.name+'">';
                });

                document.getElementById('itemnames').innerHTML = names;

                elm.setAttribute('list', 'itemnames')
            },
            error: function (data){
                //
            }
        });
    }
    
</script>
@endsection