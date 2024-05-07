@extends('dashboard')
@section('title', 'View All Category')
@section('content')
    

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>All Category</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        {{-- <li><a href="#">Tables</a></li> --}}
        <li class="active">All Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Category</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <tr>
                  <th>Category Id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Created On</th>
                  <th width="110">Action</th>
                </tr>

                @foreach($categories as $category)

                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>
                    @if($category->status == 1)
                    <span class="label label-success">Active</span>
                    @elseif($category->status == 0)
                    <span class="label label-warning">Inactive</span>
                    @endif
                  </td>
                  <td>{{ date('d M Y', strtotime($category->created_at))}}</td>
                  <td>
                    <a href="{{route('category.show',$category->id)}}" class="label label-info" title="category Details"><i class="fa fa-file-text"></i></a>
                    <a href="{{route('category.edit',$category->id)}}" class="label label-warning" title="Edit this category"><i class="fa fa-edit"></i></a>
                    
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