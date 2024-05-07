@extends('dashboard')
@section('title', 'Category Details')
@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Category Details</h1>
      <ol class="breadcrumb">
        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Categoris </a>
        </li>
        <li class="active">Details</li>
      </ol>    </section>

    <!-- Main content -->
  <section class="content">
    <div class="row"><!-- left column -->
      <div class="col-md-8"><!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title">Category Information</h4>
          </div>
          <div class="col-md-12 text-right toolbar-icon">
            <a href="{{route('category.index')}}" title="View {{Session::get('_types')}} categorys" class="label label-success"><i class="fa fa-list"></i></a>
            <a href="{{route('category.edit',$category->id)}}" class="label label-warning" title="Edit this category"><i class="fa fa-edit"></i></a>
            {{-- <a href="#" title="Print" class="label label-info"><i class="fa fa-print"></i></a> --}}
            
            {{-- <a href="{{route('category.delete',$category->id)}}" class="label label-danger" onclick="return confirm('Are you sure want to delete this account!');" title="Delete this account"><i class="fa fa-close"></i></a> --}}
            
          </div>
          <div class="col-md-12">
            <table class="table">
                <tbody>
                  <tr>
                    <th width=150>Name:</th>
                    <td>{{$category->name}}</td>
                  </tr>
                  <tr>
                    <th>Details:</th>
                    <td>{{$category->details}}</td>
                  </tr>              
                
                   <tr>
                    <th>Status:</th>
                    <td>
                      @if($category->status == 0)
                      <span class="label label-warning">Inactive</span>
                      @elseif($category->status == 1)
                      <span class="label label-success">Active</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Record Created On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($category->created_at) )}} </td>
                  </tr>
                  <tr>
                    <th>Record Updated On:</th>
                    <td>{{date('d M Y h:i:s A',strtotime($category->updated_at) )}} </td>
                  </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>

          <p><a href="{{route('category.delete',$category->id)}}" onclick="return confirm('Are sure you want to permanently delete this category?')" class="text-danger" style="padding:15px"><small>Permanently Remove?</small></a></p>
        </div>
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </section><!-- /.content -->
   
@endsection
