@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="card-header">
      <h3 class="card-title">About</h3>
      <div class="float-right">
        <a href="{{ route('about.add') }}" class="btn btn-primary">Add About</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                SL
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                About 
            </th>         
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                About Image 
            </th>         
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Message from Chairman
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Image of Chairman
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Mission
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Mission Image
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Vision
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Vision Image
            </th>
            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Action
            </th>
           
        </tr>
        </thead>
        <tbody>
        
        
                
        
        
        @foreach ($about as $item)
        <tr role="row" class="odd">
          <td class="">#</td>

          {{-- <td>{{$item->description}}</td> --}}
          <td>{{$item->about_description}}</td>
          <td><img src="{{asset($item->about_image)}}" height="80px" width="50px" alt=""></td>
          <td>{{$item->message_chairman}}</td>
          <td><img src="{{asset($item->chairman_image)}}" height="80px" width="50px" alt=""></td>
          <td>{{$item->mission}}</td>
          <td><img src="{{asset($item->mission_image)}}" height="80px" width="50px" alt=""></td>
          <td>{{$item->vision}}</td>
          <td><img src="{{asset($item->vision_image)}}" height="8px" width="50px" alt=""></td>
          
          <td class="sorting_1  btn-group">
            <a href="{{url('admin/about')}}/edit/{{$item->id}} " class="btn btn-success" style="width: 70px">Edit</a>
            <a href="{{ url('about') }}/delete/{{$item->id}}" class="btn btn-danger" style="width: 70px">Delete</a>
            <a href="#" class="btn btn-primary" style="width: 70px">View</a>

          </td>
          
          
        </tr>
        @endforeach
       
    </tbody>
       
      </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
    </div>
    <!-- /.card-body -->
  </div>
@endsection