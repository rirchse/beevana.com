@extends('dashboard')
@section('title', 'Edit Sub Category')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Sub-Category</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Sub-Category</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Sub-Category</h3>
        </div>
        <div class="col-md-12 text-right toolbar-icon">
          <a href="{{route('sub_category.show',$sub_category->id)}}" class="label label-info" title="sub_category Details"><i class="fa fa-file-text"></i></a>
          <a href="{{route('sub_category.index')}}" title="View {{Session::get('_types')}} sub_category" class="label label-success"><i class="fa fa-list"></i></a>
          {{-- <a href="{{route('sub_category.delete',$sub_category->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($sub_category, ['route' => ['sub_category.update', $sub_category->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="box-body">
        <div class="col-md-12">         
            <div class="form-group label-floating">
                {{ Form::label('name', 'Name: *', ['class' => 'control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control'])}}
            </div>  
            <div class="form-group label-floating">
                {{ Form::label('parent_id', 'Select Category: *', ['class' => 'control-label']) }}
                <select name="parent_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categoris as $category)
                    <option value="{{$category->id}}" {{ $sub_category->parent_id == $category->id ? 'selected' : ''}}>{{$category->name.' ['.$category->details.']'}}</option>
                    @endforeach
                </select>
            </div>       
            <div class="form-group label-floating">
                {{ Form::label('details', 'Details:', ['class' => 'control-label']) }}
                {!! Form::textarea('details',null,['class'=>'form-control', 'rows' => 4, 'cols' => 45]) !!}
            </div>
            <div class="form-group label-floating">
              <b>Status:</b> <br>
              {{ Form::label('status', 'Active:', ['class' => 'control-label']) }}
              {!! Form::checkbox('status', '1','checked'); !!}
          </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Update</button>
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.box -->

    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection