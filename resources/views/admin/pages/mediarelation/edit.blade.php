@extends('admin.layouts.master')

@section('content')
<div class="card-body">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit banner</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" action="" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Banner</label>
              <input type="text" name="name" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->name}}" @endif placeholder="Category Name" />
             
            </div>
           
            
                <!-- textarea -->
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" rows="3" class="form-control"  @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->description}}" @endif placeholder="description"></textarea>
                
            </div>
            <div class="form-group">
                <label>Short Description</label>
                
                <textarea type="text" name="short_description" rows="3" class="form-control"  @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->short_description}}" @endif placeholder="short description"></textarea>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">year</label>
              <input type="text" name="year" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->year}}" @endif placeholder=" year" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Age Limit</label>
              <input type="text" name="age_limit" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->age_limit}}" @endif placeholder="age limit" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Image</label>
              <img src="{{asset($info__->image)}}" height="150px" width="150px" alt="">
              <input type="file" name="image" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->image}}" @endif  />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Cinebaz(url)</label>
              <input type="text" name="cinebazurl" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->cinebazurl}}" @endif placeholder="cinebazurl" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Trailer Button Url</label>
              <input type="text" name="trailler_button_url" class="required form-control" maxlength="250" @if(!empty(old('name'))) value="{{old('name')}}" @else value="{{$info__->trailler_button_url}}" @endif placeholder="trailer url" />
            </div>
           
            
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">is active</label>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
  </div>
@endsection
