@extends('dashboard')
@section('title', 'View All Product')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>All Product</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    {{-- <li><a href="#">Tables</a></li> --}}
    <li class="active">All Product</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">List of Product</h3>
              {{-- <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Category</th>                  
                  <th>Brand</th>
                  <th>MRP Price</th>
                  <th>Status</th>
                  <th>Buying Date</th>
                  <th width="110">Action</th>
                </tr>
                @foreach($products as $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->cat_id?App\Category::find($product->cat_id)->name:''}}</td>
                  <td>{{$product->brand}}</td>
                  <td>{{$product->mrp_price}}</td>                  
                  <td>
                    @if($product->status == 1)
                    <span class="label label-success">Active</span>
                    @elseif($product->status == 0)
                    <span class="label label-warning">Inactive</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($product->buying_date))}}</td>
                  <td>
                    <a href="{{route('product.show',$product->id)}}" class="label label-info" title="product Details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('product.edit',$product->id)}}" class="label label-warning" title="Edit this product"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
                {{-- {{$products->links()}} --}}
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
    @endsection
{{-- @section('scripts')
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
@endsection --}}