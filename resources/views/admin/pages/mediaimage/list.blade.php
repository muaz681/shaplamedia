@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="card-header">
      <h3 class="card-title">Image List</h3>
      <div class="float-right">
        <a href="{{ route('mediaimage.create') }}" class="btn btn-primary">Add Image</a>
      </div>
    </div>
    <!-- /.card-header -->
   <section class="content">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered table-hover dataTable">
            <thead>
              <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                      SL
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                      Name
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                      Images
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                      Action
                  </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mediaimage as $item)
                <tr role="row" class="odd">
                  <td class="">{{$item->id}}</td>
                  <td>{{$item->media? $item->media->name :null}}</td>
                  <td>
                    @foreach (json_decode($item->image, true) as $image)
                    <img src="{{asset('uploads/mediaimage/'.$image)}}" height="150px" width="150px" alt="">
                    @endforeach

                  </td>
                  <td class="sorting_1 btn-group">
                    <a href="{{url('admin/media-image')}}/edit/{{$item->id}}" class="btn btn-success">Edit</a>
	                  <form action="{{ url('admin/media-image') }}/delete/{{$item->id}}" method="post">
		                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
		                  <button name="id" class="btn btn-danger" value="{{$item->id}}" onclick="return confirm('Are you sure?')">Delete</button>
	                  </form>
                    <a href="#" class="btn btn-primary">View</a>
                  </td>
                </tr>
              @endforeach

            </tbody>

        </table>
      </div>

  </section>
    <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
    </div>
</div>
@endsection

