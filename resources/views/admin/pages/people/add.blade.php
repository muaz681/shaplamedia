@extends('admin.layouts.master')

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div> 
  @endif

  <div class="content-wrapper">
    {{-- !-- Content Header (Page header) --> --}}
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('myexcep'))
      @dump(Session::get('myexcep'));
    @endif
    <!-- /.card-header -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{ Form::open(['method' => 'POST', 'route' => 'people.add', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
          <!-- left column -->
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                
              {{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}
                <div class="card-body">
                  <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', !empty($fdata->name) ? $fdata->name : null, ['id' => 'name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Name']) }}
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    {{ Form::label('Titel', 'Titel') }}
                    {{ Form::text('slugl', !empty($fdata->slug) ? $fdata->slug : null, ['id' => 'slug', 'class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control','placeholder' => 'Titel']) }}
                    @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                  </div>
                  <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth ') }}
                    {{ Form::date('dob', !empty($fdata->dob) ? $fdata->dob : null, ['id' => 'dob', 'class' => $errors->has('dob') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Date of Birth']) }}
                    @error('dob')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    {{ Form::label('dead', 'Date of Dead ') }}
                    {{ Form::date('dead', !empty($fdata->dead) ? $fdata->dead : null, ['id' => 'dead', 'class' => $errors->has('dead') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Date of Dead']) }}
                    @error('dead')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    {!! Form::label('image', 'Image') !!}
                    @isset($fdata->image)                  
                    <div style="min-height: 100px">
                      <img src="{{asset($fdata->image)}}" height="100px" width="auto" alt=""> 
                    </div>               
                    @endisset                                    
                    {!! Form::file('image',  ['class' => 'form-control']) !!}
                    @error('image')
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
                    {{ Form::label('link', 'Facebook Link') }}
                    {{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Facebook Link']) }}
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Email Link') }}
                    {{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Email Link']) }}
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Instagram Link') }}
                    {{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Instagram Link']) }}
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Twitter Link') }}
                    {{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Twitter Link']) }}
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('link', 'Linkedin Link') }}
                    {{ Form::text('link', !empty($fdata->link) ? $fdata->link : null, ['id' => 'link', 'class' => $errors->has('link') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Linkedin Link']) }}
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
        </div>   
        {{ Form::close() }}
      </div>
    </section>
    <!-- form start -->    
  </div>
@push('customjs')
<script type="text/javascript">

 jQuery(document).ready(function($) {
      $('.myselect2').select2();
    });

</script>
@endpush

@endsection