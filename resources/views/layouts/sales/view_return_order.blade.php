@extends('dashboard')
@section('title', 'View Returned Orders')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Returned Orders</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">All Returned Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Reurned Orders</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Mobile Number</th>
                  <th>Grand Total (tk)</th>
                  <th>Comment</th>
                  <th>Return Date</th>
                  <th>Delivery Man</th>
                  <th width="110">Action</th>
                </tr>

                @foreach($returns as $return)

                <tr>
                  <td>{{$return->order_no}}</td>
                  <td>{{$return->full_name}}</td>
                  <td>{{$return->contact}}</td>
                  <td>{{$return->gtotal}}</td>
                  <td>{{$return->comment}}</td>
                  <td>{{ date('d M Y', strtotime($return->return_date))}}</td>
                  <td>{{$return->delivery_man}}</td>
                  
                  <td>
                    <a href="/sale/{{$return->sales_id}}" class="label label-info" title="sale Details"><i class="fa fa-file-text"></i></a>
                    <a href="/return/{{$return->id}}/delete" class="label label-danger" onClick="return confirm('Are you sure you want to delete this!')" title="Delete This Item"><i class="fa fa-trash"></i></a>
                    
                  </td>
                </tr>

                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection
