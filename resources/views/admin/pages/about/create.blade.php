@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
  {{-- !-- Content Header (Page header) --> --}}
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">About</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active">About</li>
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
      {{ Form::open(['method' => 'POST', 'route' => 'about.add', 'enctype' => 'multipart/form-data']) }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add About Information</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" action="{{route('about.add')}}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  {{ Form::label('about-description', 'About Description') }}
                  {{ Form::textarea('about_description', !empty($fdata->about_description) ? $fdata->about_description : null, ['rows' => 3, 'placeholder' => 'Description..', 'class' => 'htmltexteditor form-control ' . ($errors->has('about_description') ? ' is-invalid' : '')]) }}
                  @error('about_description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div>
                <div class="form-group">
                  @isset($fdata->about_image)
                  <img src="{{asset($fdata->about_image)}}" height="100px" width="100px" alt="">  
                  @endisset
                  {!! Form::label('about_image', 'About Image') !!}
                  {!! Form::file('about_image',  ['class' => 'form-control']) !!}
                  @error('about_image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  {{ Form::label('message_chairman', 'Message From Chairman') }}
                  {{ Form::textarea('message_chairman', !empty($fdata->message_chairman) ? $fdata->message_chairman : null, ['rows' => 3, 'placeholder' => 'Message from chairman..', 'class' => 'htmltexteditor form-control ' . ($errors->has('message_chairman') ? ' is-invalid' : '')]) }}
                  @error('message_chairman')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div>
                <div class="form-group">
                  @isset($fdata->chairman_image)
                  <img src="{{asset($fdata->chairman_image)}}" height="100px" width="100px" alt="">  
                  @endisset
                  {!! Form::label('chairman_image', 'Chairman Image') !!}
                  {!! Form::file('chairman_image',  ['class' => 'form-control']) !!}
                  @error('chairman_image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  {{ Form::label('mission', 'Mission') }}
                  {{ Form::textarea('mission', !empty($fdata->mission) ? $fdata->mission : null, ['rows' => 3, 'placeholder' => 'Mission..', 'class' => 'htmltexteditor form-control ' . ($errors->has('mission') ? ' is-invalid' : '')]) }}
                  @error('message_chairman')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div>
                <div class="form-group">
                  @isset($fdata->mission_image)
                  <img src="{{asset($fdata->mission_image)}}" height="100px" width="100px" alt="">  
                  @endisset
                  {!! Form::label('mission_image', 'Mission Image') !!}
                  {!! Form::file('mission_image',  ['class' => 'form-control']) !!}
                  @error('mission_image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  {{ Form::label('vision', 'Vision') }}
                  {{ Form::textarea('vision', !empty($fdata->vision) ? $fdata->vision : null, ['rows' => 3, 'placeholder' => 'Vision..', 'class' => 'htmltexteditor form-control ' . ($errors->has('vision') ? ' is-invalid' : '')]) }}
                  @error('vision')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror    
                </div> 
                <div class="form-group">
                  @isset($fdata->vision_image)
                  <img src="{{asset($fdata->vision_image)}}" height="100px" width="100px" alt="">  
                  @endisset
                  {!! Form::label('vision_image', 'Vision Image') !!}
                  {!! Form::file('vision_image',  ['class' => 'form-control']) !!}
                  @error('vision_image')
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
            </form>
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



