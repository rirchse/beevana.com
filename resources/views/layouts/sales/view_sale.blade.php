@extends('dashboard')
@section('title', 'View All Orders')
@section('content')

    <section class="content-header">
      <h1>View {{$type != '' ?$type:'All'}} Orders</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
        <li class="active">All Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Orders</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" id="search_sales" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <a href="/sale" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                <tr>
                  <th>#</th>
                  <th>Customer Name</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Grand Total</th>
                  <th>Paid</th>
                  <th>Due</th>
                  <th>Sales Date</th>
                  <th>Sold By</th>
                  <th>Status</th>
                  <th width="120">Action</th>
                </tr>

                <tbody  id="ordersTable">

                @foreach($sales as $sale)
                <tr>
                  <td>{{$sale->order_no}}</td>
                  <td>{{$sale->full_name}}</td>
                  <td>{{$sale->contact}}</td>
                  <td>{{$sale->shipping_address??$sale->address}}</td>
                  <td>{{$sale->gtotal}} tk</td>
                  <td>{{$sale->paid}} tk</td>
                  <td>{{$sale->due}} tk</td>
                  <td>{{date('d M Y', strtotime($sale->sales_date))}}</td>
                  <td>{{App\User::find($sale->sold_by)?App\User::find($sale->sold_by)->name:''}}</td>
                  <td>
                    @if($sale->status == 0)
                    <span class="label label-info">Pending</span>
                    @elseif($sale->status == 1)
                    <span class="label label-warning">Confirmed</span>
                    @elseif($sale->status == 2)
                    <span class="label label-success">Completed</span>
                    @elseif($sale->status == 3)
                    <span class="label label-danger">Cancelled</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{route('sale.show', $sale->id)}}" class="label label-info" title="Sale details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('sale.edit',$sale->id)}}" class="label label-warning" title="Edit this sale"><i class="fa fa-edit"></i></a>
                    <a href="/sale/{{$sale->id}}/print" class="label label-{{$sale->print_status?'default':'primary'}}" title="Print"><i class="fa fa-print"></i></a>
                  </td>
                </tr>

                @endforeach
              </tbody>
              </table>
            </div> <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
                {{$sales->links()}}
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
    var search_sales = document.getElementById('search_sales');
    // var search_value = search_sales.value;
    
      search_sales.addEventListener('keyup', searchSale);
    
    function searchSale () {
      if(search_sales.value.length > 0){
      $.ajax({
        type: 'GET',
        url:'/search/orders/'+search_sales.value,
        success: function (data){
          
          var obj = JSON.parse(JSON.stringify(data));
          if(obj['success'] == null){
            alert('Orders not found.');
            return false;
          }

          var orders = "";
          var status = "";

          function dateFormat(element){
            var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var date = new Date(element);
            return date.getDate()+' '+month[date.getMonth()]+' '+date.getFullYear();
          }

          $.each(obj['success'], function (key, val){
            if(val.status == 0){
              status = '<span class="label label-info">New Order</span>';
            } else if(val.status == 1){
              status = '<span class="label label-warning">Confirmed</span>';
            }else if(val.status == 2){
              status = '<span class="label label-success">Completed</span>';
            }else if(val.status == 3){
              status = '<span class="label label-danger">Cancelled</span>';
            }else{
              //
            }

            var order_no = '';
            if(val.order_no){
              order_no = val.order_no;
            }

            var address = val.address;
            if(val.shipping_address){
              address = val.shipping_address;
            }


            orders += '<tr>'+
            '<td>'+order_no+'</td>'+
              '<td>'+val.full_name+'</td>'+
              '<td>'+val.contact+'</td>'+
              '<td>'+address+'</td>'+
              '<td>'+val.gtotal+' tk</td>'+
              '<td>'+val.paid+' tk</td>'+
              '<td>'+val.due+' tk</td>'+
              '<td>'+dateFormat(val.sales_date)+'</td>'+
              '<td>'+val.name+'</td>'+
              '<td>'+status+'</span></td>'+
              '<td>'+
                '<a href="/sale/'+val.id+'" class="label label-info" title="sale Details" marked="1"><i class="fa fa-file-text"></i></a>'+
                '<a href="/sale/'+val.id+'/edit" class="label label-warning" title="Edit this sale" marked="1"><i class="fa fa-edit"></i></a>'+
                '<a href="/return/'+val.id+'/order" class="label label-default" title="Add to return"><i class="fa fa-undo"></i></a>'+
              '</td>'+
            '</tr>';
          });

          $("#ordersTable").html(orders);
        },
        error: function (data){
          alert('Could not retrive data from database!');
        }
      });
}
    }
    </script>
@endsection