@extends('dashboard')
@section('title', 'Vendor Details')
@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Vendor Details</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Vendors</a></li>
        <li class="active">Details</li>
      </ol>
    </section>

    <!-- Main content -->
  <section class="content">
    <div class="row"><!-- left column -->
      <div class="col-md-6"><!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title">Vendor Information</h4>
          </div>
          <div class="col-md-12 text-right toolbar-icon">
            <a href="{{route('vendor.index')}}" title="View {{Session::get('_types')}} vendors" class="label label-success"><i class="fa fa-list"></i></a>
            <a href="{{route('vendor.edit',$vendor->id)}}" class="label label-warning" title="Edit this vendor"><i class="fa fa-edit"></i></a>
            {{-- <a href="#" title="Print" class="label label-info"><i class="fa fa-print"></i></a> --}}
            
            {{-- <a href="{{route('vendor.delete',$vendor->id)}}" class="label label-danger" onclick="return confirm('Are you sure want to delete this account!');" title="Delete this account"><i class="fa fa-close"></i></a> --}}
            
          </div>
          <div class="col-md-12">
            <table class="table">
                <tbody>
                  <tr>
                    <th width="150">Name:</th>
                    <td>{{$vendor->name}}</td>
                  </tr>
                  
                  <tr>
                    <th>Email:</th>
                    <td>{{$vendor->email}}</td>
                  </tr>
                  <tr>
                    <th>Contact:</th>
                    <td>{{$vendor->contact}}</td>
                  </tr>
                  <tr>
                    <th>Address:</th>
                    <td>{{$vendor->address}}</td>
                  </tr>
                  <tr>
                    <th>Business Name:</th>
                    <td>{{$vendor->business_name}}</td>
                  </tr>
                  <tr>
                    <th>Details:</th>
                    <td>{{$vendor->details}}</td>
                  </tr>              
                
                   <tr>
                    <th>Status:</th>
                    <td>
                      @if($vendor->status == 0)
                      <span class="label label-warning">Unverified</span>
                      @elseif($vendor->status == 1)
                      <span class="label label-success">Active</span>
                      @elseif($vendor->status == 2)
                      <span class="label label-danger">Disabled</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Record Created On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($vendor->created_at) )}} </td>
                  </tr>
                  <tr>
                    <th>Record Updated On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($vendor->updated_at) )}} </td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>

          <p><a href="{{route('vendor.delete',$vendor->id)}}" onclick="return confirm('Are sure you want to permanently delete this vendor?')" class="text-danger" style="padding:15px">Permanently Remove?</a></p>
        </div>
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </section><!-- /.content -->
   
@endsection
