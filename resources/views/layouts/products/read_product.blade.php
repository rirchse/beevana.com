@extends('dashboard')
@section('title', 'Product Details')
@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product Details</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
        <li class="active">Details</li>
      </ol>    
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="row"><!-- left column -->
      <div class="col-md-8"><!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title">Product Information</h4>
          </div>
          <div class="col-md-12 text-right toolbar-icon">
            <a href="/product/create" title="Add New Product" class="label label-info"><i class="fa fa-plus"></i></a>
            <a href="/product" title="View {{Session::get('_types')}} products" class="label label-success"><i class="fa fa-list"></i></a>
            <a href="{{route('product.edit',$product->id)}}" class="label label-warning" title="Edit this product"><i class="fa fa-edit"></i></a>
            
            {{-- <a href="{{route('product.delete',$product->id)}}" class="label label-danger" onclick="return confirm('Are you sure want to delete this account!');" title="Delete this account"><i class="fa fa-close"></i></a> --}}
            
          </div>
          <div class="col-md-12">
            <table class="table">
                <tbody>
                  <tr>
                    <th style="width: 200px;">Name:</th>
                    <td>{{$product->name}}</td>
                  </tr>
                  <tr>
                    <th>Category:</th>
                    <td>{{$product->cat_id?App\Category::find($product->cat_id)->name:''}}</td>
                  </tr>
                  <tr>
                    <th>Sub Category:</th>
                    <td>{{$product->sub_cat_id?App\Subcategory::find($product->sub_cat_id)->name:''}}</td>
                  </tr>
                  <tr>
                    <th>Vendor:</th>
                    <td>{{$product->vendor?App\Vendor::find($product->vendor)->name:''}}</td>
                  </tr>
                <tr>
                    <th>Brand:</th>
                    <td>{{$product->brand}}</td>
                  </tr>
                <tr>
                    <th>MRP Price:</th>
                    <td>{{$product->mrp_price}}</td>
                  </tr>
                <tr>
                    <th>Credit Price:</th>
                    <td>{{$product->credit_price}}</td>
                  </tr>
                <tr>
                <tr>
                  <th>Cash Price:</th>
                  <td>{{$product->cash_price}}</td>
                </tr>
                <tr>
                  <th>Buying Price:</th>
                  <td>{{$product->buying_price}}</td>
                </tr>
                <tr>
                    <th>Serial No:</th>
                    <td>{{$product->serial_no}}</td>
                  </tr>
                  <tr>
                    <th>Details:</th>
                    <td>{{$product->details}}</td>
                  </tr>
                
                   <tr>
                    <th>Status:</th>
                    <td>
                      @if($product->status == 0)
                      <span class="label label-warning">Unactive</span>
                      @elseif($product->status == 1)
                      <span class="label label-success">Active</span>
                      @elseif($product->status == 2)
                      <span class="label label-danger">Disabled</span>
                      @endif
                    </td>
                  </tr>
                  
                  <tr>
                    <th>Product Buying Date:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($product->buying_date) )}} </td>
                  </tr>
                  <tr>
                    <th>Record Created On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($product->created_at) )}} </td>
                  </tr>
                  <tr>
                    <th>Record Updated On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($product->updated_at) )}} </td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <p><a href="{{route('product.delete',$product->id)}}" onclick="return confirm('Are sure you want to permanently delete this product?')" class="text-danger" style="padding:15px">Permanently Remove?</a></p>
        </div>
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </section><!-- /.content -->
   
@endsection
