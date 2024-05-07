@extends('dashboard')
@section('title', 'View All Customers')
@section('content')
    

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customers Accounts</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
        <li class="active">Customers Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Customer Accounts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Contact</th>
                  {{-- <th>Phone</th> --}}
                  <th>Address</th>
                  {{-- <th>Status</th> --}}
                  <th>First Order Date</th>
                  <th width="110">Action</th>
                </tr>

                @foreach($customers as $customer)

                <tr>
                  <td>{{$customer->id}}</td>
                  <td>{{$customer->full_name}}</td>
                  <td>{{$customer->contact}}</td>
                  {{-- <td>{{$customer->phone}}</td> --}}
                  <td>{{$customer->address}}</td>
                  {{-- <td>
                    @if($customer->status == 1)
                    <span class="label label-success">Verified</span>
                    @elseif($customer->status == 0)
                    <span class="label label-warning">Unverified</span>
                    @elseif($customer->status == 3)
                    <span class="label label-danger">Deleted</span>
                    @endif
                  </td> --}}

                  <td>{{ date('d M Y', strtotime($customer->created_at))}}</td>
                  <td>
                    <a href="{{route('customer.show',$customer->id)}}" class="label label-info" title="Customer details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('customer.edit',$customer->id)}}" class="label label-warning" title="Edit this customer"><i class="fa fa-edit"></i></a>
                    {{-- @if($customer->status == 1)
                    <a href="/admin/customer_login/{{$customer->email}}" class="label label-success" title="Login to this account" target="_blank"><i class="fa fa-search-plus"></i></a>
                    @endif
                    @if($customer->status == 0)
                    <a href="/admin/resend_email_verification/{{$customer->id}}" class="label label-primary" onclick="return confirm('Are you sure you want to resend email verification to this customer?')" title="Resend verification email."><i class="fa fa-envelope-o"></i></a>
                    @endif
                    @if($customer->status == 3)
                    <a href="/admin/customer/{{$customer->id}}/restore" class="label label-success" title="Restore the account" onclick="return confirm('Are you sure you want to restore the account?')"><i class="fa fa-undo"></i></a>
                    @endif --}}
                  </td>
                </tr>

                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
                {{-- {{$customers->links()}} --}}
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