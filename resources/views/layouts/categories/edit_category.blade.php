@extends('dashboard')
@section('title', 'Edit Category')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Edit Category</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Category</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row"> <!-- left column -->
    <div class="col-md-6"> <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Category</h3>
        </div>
        <div class="col-md-12 text-right toolbar-icon">
          <a href="{{route('category.show',$category->id)}}" class="label label-info" title="category Details"><i class="fa fa-file-text"></i></a>
          <a href="{{route('category.index')}}" title="View {{Session::get('_types')}} category" class="label label-success"><i class="fa fa-list"></i></a>
          {{-- <a href="{{route('category.delete',$category->id)}}" class="label label-danger" title="Delete this account"><i class="fa fa-trash"></i></a> --}}
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="box-body">
          <div class="form-group">
            {{ Form::label('category', 'Name:', ['class' => 'control-label']) }}
            {{ Form::text('name', $category->name, ['class' => 'form-control'])}}
          </div>

          <div class="form-group label-floating">
            {{ Form::label('details', 'Details', ['class' => 'control-label']) }}
            {!! Form::textarea('details',$category->deteils,['class'=>'form-control', 'rows' => 4, 'cols' => 45]) !!}
          </div>
          <div class="form-group label-floating">
            {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
            {!! Form::checkbox('status', '1') !!}
          </div>
          
        </div>
        <!-- /.box-body -->

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