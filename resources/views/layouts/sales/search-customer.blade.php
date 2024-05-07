@extends('dashboard')
@section('title', 'Create a Sale')
@section('content')
<section class="content-header">
  <h1>Create Sale</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Sales</a></li>
    <li class="active">Create Sale</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 style="color: #800" class="box-title">Search Customer</h3>
        </div>
      {!! Form::open(['route' => 'customer.search', 'method' => 'POST', 'files' => true]) !!}
        <div class="box-body">
            <div class="col-sm-10">
                <div class="form-group label-floating">
                    {{ Form::label('customer', 'Search Customer:', ['class' => 'control-label']) }}
                    {{ Form::text('customer', null, ['class' => 'form-control', 'required' => '','placeholder'=>'Search by customer name and mobile number'])}}
                </div>            
            </div>
            <div class="col-sm-2"><br>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"> </i> Search</button>
            </div>
            <div class="clearfix"></div>
            {!! Form::close() !!}
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div> <!--/.col (left) -->

    @if(!empty($customers))

    <div class="col-md-8">
      <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 style="color: #800" class="box-title">Search Results</h3>
            </div>
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                  <table id="datatables" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>

                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->full_name}}</td>
                            <td>{{$customer->contact}}</td>
                            <td><a class="btn btn-warning btn-xs" href="/sale/{{$customer->id}}/product">Select</a></td>
                        </tr>
                        @endforeach

                    </thead>
                  </table>
              </div>
            </div>
        </div>
    </div>
    @endif
</div> <!-- /.row -->
</section> <!-- /.content -->
@endsection