@extends('dashboard')
@section('title', 'Edit Product')
@section('content')
<section class="content-header">
  <h1>
    Product
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Product</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product</h3>
      </div>
      <div class="col-md-12 text-right toolbar-icon">
          <a href="{{route('product.show',$product->id)}}" class="label label-info" title="product Details"><i class="fa fa-file-text"></i></a>
          <a href="{{route('product.index')}}" title="View {{Session::get('_types')}} product" class="label label-success"><i class="fa fa-list"></i></a>
          {{-- <a href="{{route('product.delete',$product->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {!! Form::model($product, ['route' => ['product.update', $product->id], 'method' => 'PUT', 'files' => true]) !!}
      <div class="box-body">
        <div class="col-md-6">
           <div class="form-group label-floating">
            {{ Form::label('name', 'Product Name: *', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control'])}}
        </div>
        <div class="form-group label-floating">
            {{ Form::label('category', 'Category: *', ['class' => 'control-label']) }}
            <select name="category" class="form-control" >
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}"{{ $product->cat_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group label-floating">
            {{ Form::label('sub_cat', 'Sub Category:', ['class' => 'control-label']) }}
            <select name="sub_cat" class="form-control" >
                <option value="">Select SubCategory</option>
                @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}"  {{ $product->sub_cat_id == $subcategory->id ? 'selected' : ''}}>{{$subcategory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group label-floating">
            {{ Form::label('vendor', 'Vendor:', ['class' => 'control-label']) }}
            <select name="vendor" class="form-control" >
                <option value="">Select Vendor</option>
                @foreach($vendors as $vendor)
                <option value="{{$vendor->id}}"  {{ $product->vendor == $vendor->id ? 'selected' : ''}}>{{$vendor->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group label-floating">
            {{ Form::label('brand', 'Brand: *', ['class' => 'control-label']) }}
            <input list="brand" name="brand" class="form-control" value="{{$product->brand}}">
            <datalist id="brand">
                <option value="Non Brand">
                <option value="waltone">
                <option value="sony">
                <option value="RFL">                
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
            {{ Form::label('buying_date', 'Buying Date:*', ['class' => 'control-label']) }}
            {{ Form::date('buying_date', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group label-floating">
            {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
            {{ Form::textarea('details', null,['class' => 'form-control','rows' => 2]) }}
        </div>
        <div class="form-group label-floating">
            <b>Status:</b><br>
            {{ Form::label('status', 'Active:', ['class' => 'control-label']) }}
            {!! Form::checkbox('status', '1'); !!}
        </div>



{{--         <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="width:250px;">                    
                <div>
                    <span class="btn-round btn-rose btn-file btn-small">
                        <span class="fileinput-new">Add Photo</span>
                        <input type="file" name="image">
                    </span>
                    <br />
                </div>
            </div>
        </div>
 --}}
        
        <button type="submit" class="btn btn-primary pull-right">Save</button>
    </div>
    <div class="clearfix"></div>
    {!! Form::close() !!}
</div> <!-- /.box -->
</div>
<!-- /.box -->

</div>
<!--/.col (left) -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
@endsection