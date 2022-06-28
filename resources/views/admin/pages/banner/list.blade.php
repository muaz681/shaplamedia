@extends('admin.layouts.master')

@section('content')
  <div class="content-wrapper">
    <div class="card-header">
      <h3 class="card-title">Banner List</h3>
      <div class="float-right">
        <a href="{{ route('banner.add') }}" class="btn btn-primary">Add Banner</a>
      </div>
    </div>
    <!-- /.card-header -->
    <section class="content">
      <div class="card">
        {{ Form::open(['method' => 'GET', 'enctype' => 'multipart/form-data']) }}
            <div class="card-header">
              <div class="row px-2">
                <div class="w-auto">
                  {{ Form::select('per_page', array_combine([5,10,20,40], [5,10,20,40]), $request->per_page, ['class' => 'form-control autoSubmit']) }}
                </div>
                <div class="w-auto mx-2">
                  <a href="{{ route('banner.add') }}" class="btn btn-outline-primary">+ Add Banner</a>
                </div>
                <div class="w-auto mx-2">
                  <a href="{{ route('banner.index') }}" class="btn btn-outline-secondary btn-sm mt-1"><i class="fa fa-undo"></i>Clear</a>
                </div>
                <div class="w-auto ml-auto">
                  <h3 class="card-title">Showing {{$banner->firstItem()}}-{{$banner->lastItem()}} of {{$banner->total()}} items.</h3>
                </div>
              </div>
            </div>
        <div class="card-body">    
          <table class="table table-bordered table-hover dataTable" >
            <thead>
              <tr role="row">
                  <th>Id</th>
                  <th>Name</th>
                  <th>Slider</th>
                  <th>Action</th> 
              </tr>
              <tr>
                  <th><input type="number" name="id" class="form-control autoSubmit" value="{{$request->id}}"></th>
                  <th><input type="text" name="title" class="form-control autoSubmit" value="{{$request->title}}"></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($banner as $item)
                <tr role="row" class="odd">
                  <td class="">{{$item->id}}</td>
                  <td>{{$item->title}}</td>
                  <td><img src="{{asset($item->image)}}" height="150px" width="150px" alt=""></td>
                  <td class="sorting_1 btn-group">
                    <a href="{{url('admin/banner')}}/edit/{{$item->id}}" class="btn btn-success">Edit</a>
                    <a href="{{ url('admin/banner') }}/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
                    <a href="#" class="btn btn-primary">View</a>
                  </td>                  
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer clearfix">
               {!! $banner->withQueryString()->links('pagination::bootstrap-4') !!}
        </div>
      </div>
    </section>
    <!-- /.card-body -->
  </div>
@endsection
@push('customjs')
<script>
  $(".autoSubmit").change(function() {
    $(this).parents("form").submit()
  });
</script>
@endpush