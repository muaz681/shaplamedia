@extends('admin.layouts.master')
@section('content')
  <div class="content-wrapper">
      <div class="card-header">
        <h3 class="card-title">Media List</h3>

      </div>
          <!-- Main content -->
    @if(Session::has('myexcep'))
        @dump(Session::get('myexcep'));
    @endif
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
              <a href="{{ route('media.add') }}" class="btn btn-outline-primary">+ Add Media</a>
            </div>
            <div class="w-auto mx-2">
              <a href="{{ route('media.index') }}" class="btn btn-outline-secondary btn-sm mt-1"><i class="fa fa-undo"></i>Clear</a>
            </div>
            <div class="w-auto ml-auto">
              <h3 class="card-title">Showing {{$movie->firstItem()}}-{{$movie->lastItem()}} of {{$movie->total()}} items.</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                    <th width="90">ID</th>
                    <th>Name</th>
                    <th>Media Type</th>
                    <th>Release Date</th>
                    <th>Landscape Image</th>
                    <th>Portrait Image</th>
                    <th>Action</th>
                  </tr>
                <tr>
                  <th><input type="number" name="id" class="form-control autoSubmit" value="{{$request->id}}"></th>
                  <th><input type="text" name="name" class="form-control autoSubmit" value="{{$request->name}}"></th>
                  <th>
                    {{ Form::select('media_type', getMediaTypes(), $request->media_type, ['class' => 'form-control autoSubmit', 'placeholder' => 'Select Media Type']) }}
                  </th>
                  <th><input type="date" name="release_date" class="form-control autoSubmit" value="{{$request->release_date}}"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($movie as $item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->media_type}}</td>
                  <td>{{$item->release_date}}</td>
                  <td><img src="{{asset($item->landscapeimage)}}" height="100px" width="auto" alt=""></td>
                  <td><img src="{{asset($item->potraitimage)}}" height="100px" width="auto" alt=""></td>
                  <td class="btn-group btn-group-sm">
                    <a href="{{url('/admin/media')}}/edit/{{$item->id}}" class="btn btn-success">Edit</a>
                    <a href="{{ url('/admin/media') }}/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
                    <a href="{{ url('/media/'.$item->slug) }}" class="btn btn-primary">View</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {!! $movie->withQueryString()->links('pagination::bootstrap-4') !!}
        </div>
        {{ Form::close() }}
      </div>
    </section>
  </div>
@endsection

@push('customjs')
  <script>
    $(".autoSubmit").change(function() {
      $(this).parents("form").submit()
    });
  </script>
@endpush