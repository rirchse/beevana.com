@extends('dashboard')
@section('title', 'View All Sub-Category')
@section('content')

    <section class="content-header">
      <h1>All Sub-Category</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">All Sub-Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Sub-Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Category Name</th>                  
                  <th>Status</th>
                  <th>Created On</th>
                  <th width="110">Action</th>
                </tr>

                @foreach($sub_categoris as $sub_category)

                <tr>
                  <td>{{$sub_category->id}}</td>
                  <td>{{$sub_category->name}}</td>
                  <td>{{$sub_category->parent_id?App\Category::find($sub_category->parent_id)->name:''}}</td>
                  <td>
                    @if($sub_category->status == 1)
                    <span class="label label-success">Active</span>
                    @elseif($sub_category->status == 0)
                    <span class="label label-warning">Inactive</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($sub_category->created_at))}}</td>
                  <td>
                    <a href="{{route('sub_category.show',$sub_category->id)}}" class="label label-info" title="sub_category Details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('sub_category.edit',$sub_category->id)}}" class="label label-warning" title="Edit this sub_category"><i class="fa fa-edit"></i></a>
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
