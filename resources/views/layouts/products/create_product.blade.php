@extends('dashboard')
@section('title', 'Add New Product')
@section('content')
<section class="content-header">
  <h1>Add a Product</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
    <li class="active">Add Product</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-10"> <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #800" class="box-title">Product Details</h3>
        </div>
        {!! Form::open(['route' => 'product.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="box-body">
            <div class="col-md-6">
           <div class="form-group label-floating">
            {!! Form::label('name', 'Product Name: *', ['class' => 'control-label']) !!}
            {{ Form::text('name', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('category', 'Category: *', ['class' => 'control-label']) }}
                <select name="category" class="form-control" onchange="getsubcats(this)">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group label-floating">
                {{ Form::label('sub_cat', 'Sub Category:', ['class' => 'control-label']) }}
                <select id="sub_cat" name="sub_cat" class="form-control">
                    <option value="">Select SubCategory</option>
                </select>
            </div>
            <div class="form-group label-floating">
                {{ Form::label('vendor', 'Vendor: *', ['class' => 'control-label']) }}
                <select name="vendor" class="form-control">
                    <option value="">Select Vendor</option>
                    @foreach($vendors as $vendor)
                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group label-floating">
                {{ Form::label('brand', 'Brands: *', ['class' => 'control-label']) }}
                <input list="brand" name="brand" class="form-control">
                <datalist id="brand">
                    @foreach(App\Product::groupBy('brand')->select('brand')->get() as $key => $value)
                    <option value="{{$value->brand}}">
                    @endforeach                
                </datalist>
            </div>       
            <div class="form-group label-floating">
                {{ Form::label('serial_no', 'Serial Number:', ['class' => 'control-label']) }}
                {{ Form::text('serial_no', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group label-floating">
                {{ Form::label('stock', 'Stock: *', ['class' => 'control-label']) }}
                {{ Form::number('stock', null, ['class' => 'form-control']) }}
            </div>        
            </div>
            <div class="col-md-6">
            <div class="form-group label-floating">
                {{ Form::label('mrp_price', 'MRP Price: *', ['class' => 'control-label']) }}
                {{ Form::number('mrp_price', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('credit_price', 'Credit Price:', ['class' => 'control-label']) }}
                {{ Form::number('credit_price', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('cash_price', 'Cash price:', ['class' => 'control-label']) }}
                {{ Form::number('cash_price', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('buying_price', 'Buying Price:', ['class' => 'control-label']) }}
                {{ Form::number('buying_price', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group label-floating">
                {{ Form::label('buying_date', 'Buying Date: *', ['class' => 'control-label']) }}
                {{ Form::date('buying_date', null, ['class' => 'form-control']) }}
            </div>
                <div class="form-group label-floating">
                    {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                    {{ Form::textarea('details', null,['class' => 'form-control','rows' => 3]) }}
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group label-floating">
                <b>Status: </b>
                {{ Form::label('status', 'Active:', ['class' => 'control-label']) }}
                {!! Form::checkbox('status', '1','checked'); !!}
            </div>

            </div>
            <div class="clearfix"></div>
        </div> <!-- /.box -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
        </div>
    {!! Form::close() !!}
</div> <!--/.col (left) -->
</div> <!-- /.row -->
</section> <!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript">
    function getsubcats(elm){

        var catid = elm.options[elm.options.selectedIndex].value;

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/get_sub_cats/'+catid,
            success: function (data) {

                var obj = JSON.parse(JSON.stringify(data));
                var sub_cat_html = "";

                $.each(obj['subcats'], function (key, val) {
                   sub_cat_html += "<option value="+val.id+">"+val.name+"</option>";
                });

                if(sub_cat_html != ""){
                    $("#sub_cat").html('<option value="">Select SubCategory</option>'+sub_cat_html)
                }else{
                    $("#sub_cat").html('<option value="">No SubCategory</option>')
                }

                // console.log(obj['subcats'].count());

                // $("#sub_cat").append(you_html); //// For Append
                   //// For replace with previous one
            },
            error: function(data) { 
                 console.log('data error');
            }
        });
    }

    // getsubcats(elm);
</script>
@endsection