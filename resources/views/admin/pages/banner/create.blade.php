@extends('admin.layouts.master')

@section('content')
  @if (Session::has('myexcep'))
    @dump(Session::get('myexcep'));
  @endif

<div class="content-wrapper">
  {{-- !-- Content Header (Page header) --> --}}
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Slider</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Slider</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
   
  <!-- /.card-header -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      {{ Form::open(['method' => 'POST', 'route' => 'banner.add', 'enctype' => 'multipart/form-data']) }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
               
              {{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}
              <div class="card-body">
                <div class="form-group">
                  {{ Form::label('title', 'Banner Title') }}
                  {{ Form::text('title', !empty($fdata->title) ? $fdata->title : null, ['id' => 'title', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Title']) }}
                  @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  {{ Form::label('media_id', 'Media') }}
                  {{ Form::select('media_id', getMediaArr(), $fdata && $fdata->media ? $fdata->media->id : null, ['class' => $errors->has('media_id') ? 'form-control myselect2  is-invalid' : 'form-control myselect2','placeholder' => 'Select a Media']) }}
                  @error('media_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
            
                <div class="form-group">
                  {{ Form::label('description', 'Description') }}
                  {{ Form::textarea('description', !empty($fdata->description) ? $fdata->description : null, ['rows' => 3, 'placeholder' => 'Description..', 'class' => 'htmltexteditor form-control ' . ($errors->has('description') ? ' is-invalid' : '')]) }}
                  @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div>
                <div class="form-group">
                  {{ Form::label('short_description', 'Short Description') }}
                  {{ Form::textarea('short_description', !empty($fdata->short_description) ? $fdata->short_description : null, ['rows' => 3, 'placeholder' => 'short description..', 'class' => 'htmltexteditor form-control ' . ($errors->has('short_description') ? ' is-invalid' : '')]) }}
                  @error('short_description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div>
                <div class="form-group">
                  {{ Form::label('name', 'Year') }}
                  {{ Form::date('year', !empty($fdata->year) ? $fdata->year : null, ['id' => 'name', 'class' => $errors->has('year') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'year']) }}
                  @error('year')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>
                <div class="form-group">
                  {{ Form::label('age_limit', 'Age Limit') }}
                  {{ Form::text('age_limit', !empty($fdata->year) ? $fdata->year : null, ['id' => 'year', 'class' => $errors->has('year') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'age limit']) }}
                  @error('age_limit')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>
                <div class="form-group">
                  @isset($fdata->image)
                  <img src="{{asset($fdata->image)}}" height="100px" width="100px" alt="">  
                  @endisset
                  {!! Form::label('image', 'Image') !!}
                  {!! Form::file('image',  ['class' => 'form-control']) !!}
                  @error('image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-group">
                  {{ Form::label('cinebazurl', 'Cinebaz(url)') }}
                  {{ Form::text('cinebazurl', !empty($fdata->cinebazurl) ? $fdata->cinebazurl : null, ['id' => 'cinebazurl', 'class' => $errors->has('cinebazurl') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'cinebazurl']) }}
                  @error('cinebazurl')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>
                <div class="form-group">
                  {{ Form::label('trailler_button_url', 'Trailer Button Url') }}
                  {{ Form::text('trailler_button_url', !empty($fdata->trailler_button_url) ? $fdata->trailler_button_url : null, ['id' => 'trailler_button_url', 'class' => $errors->has('trailler_button_url') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'trailler button url']) }}
                  @error('trailler_button_url')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
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
              
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-3">

          @include('admin.pages.seo.seo', ['sdata' => ($fdata && $fdata->seo)?$fdata->seo:null])
        </div>
        
        <!--/.col (left) -->

      </div>
      {{ Form::close() }}
    </div>
  </section>
  <!-- form start -->
        
  
</div>

@endsection
