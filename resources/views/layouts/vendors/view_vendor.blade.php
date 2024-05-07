@extends('dashboard')
@section('title', 'View All Vendors')
@section('content')
    

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Vendor Accounts</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Vendors</a></li>
        <li class="active">Vendor Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Vendor Accounts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Busines Name</th>
                  <th>Status</th>
                  <th>Deteils</th>
                  <th>Created On</th>
                  <th width="110">Action</th>
                </tr>

                @foreach($vendors as $vendor)

                <tr>
                  <td>{{ $vendor->id }}</td>
                  <td>{{$vendor->name}}</td>
                  <td>{{$vendor->contact}}</td>
                  <td>{{$vendor->business_name}}</td>
                  <td>
                    @if($vendor->status == 1)
                    <span class="label label-success">Verified</span>
                    @elseif($vendor->status == 0)
                    <span class="label label-warning">Unverified</span>
                    @elseif($vendor->status == 3)
                    <span class="label label-danger">Deleted</span>
                    @endif
                  </td>
                  <td>{{$vendor->details}}</td>

                  <td>{{ date('d M Y', strtotime($vendor->created_at))}}</td>
                  <td>
                    <a href="{{route('vendor.show',$vendor->id)}}" class="label label-info" title="vendor Details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('vendor.edit', $vendor->id)}}" class="label label-warning" title="Edit this vendor"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>

                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <div class="pagination-sm no-margin pull-right">
                {{-- {{$vendors->links()}} --}}
              </div>
            </div>
          </div> <!-- /.box -->
        </div>
      </div>
    </section> <!-- /.content -->
@endsection