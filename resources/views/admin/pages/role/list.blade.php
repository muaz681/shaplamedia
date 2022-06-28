@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper" style="min-height: 1200.88px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Role </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            {{-- <li class="breadcrumb-item active">Dashboard v3</li> --}}
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Role List</h3>
            </div>
            {{ Form::open(['method' => 'GET', 'enctype' => 'multipart/form-data']) }}
              <div class="card-header">
                <div class="row px-2">
                  <div class="w-auto">
                    {{ Form::select('per_page', array_combine([5,10,20,40], [5,10,20,40]), $request->per_page, ['class' => 'form-control autoSubmit']) }}
                  </div>
                  <div class="w-auto mx-2">
                    <a href="{{ route('role.add') }}" class="btn btn-outline-primary">+ Add Role</a>
                  </div>
                  <div class="w-auto mx-2">
                    <a href="{{ route('role.index') }}" class="btn btn-outline-secondary btn-sm mt-1"><i class="fa fa-undo"></i>Clear</a>
                  </div>
                  <div class="w-auto ml-auto">
                    <h3 class="card-title">Showing {{$role->firstItem()}}-{{$role->lastItem()}} of {{$role->total()}} items.</h3>
                  </div>
                </div>
              </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr role="row">
                      <th> ID </th>
                      <th> Title </th>
                      <th> Name </th>
                      <th> Is Important </th>
                      <th> Is Character </th>
                      <th> Position </th>
                      <th>Action</th>  
                  </tr>
                   <tr>
                    <th><input type="number" name="id" class="form-control autoSubmit" value="{{$request->id}}"></th>
                    <th><input type="text" name="title" class="form-control autoSubmit" value="{{$request->title}}"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($role as $item)
                  <tr role="row" class="odd">
                    <td class="">{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->is_important}}</td>
                    <td>{{$item->is_character}}</td>
                    <td>{{$item->sort_by}}</td>
                    <td class="sorting_1 btn-group">
                      <a href="{{url('admin/role')}}/edit/{{$item->id}}" class="btn btn-success">Edit</a>
                      <a href="{{ route('role.delete',$item->id) }}" class="btn btn-danger">Delete</a>
                      <a href="#" class="btn btn-primary">View</a>
                    </td> 
                  </tr>
                @endforeach  
                </tbody>
              </table>
            </div>
            <div class="card-footer clearfix">
               {!! $role->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .w-5{
    display: none;
  }
</style>
@endsection
@push('customjs')
<script>
  $(".autoSubmit").change(function() {
    $(this).parents("form").submit()
  });
</script>
@endpush