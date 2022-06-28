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
            <h1 class="m-0 text-dark">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
        <div class="row">
          <!-- left column --> 
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{ Form::open(['method' => 'POST', 'route' => 'role.add', 'enctype' => 'multipart/form-data']) }}
                {{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}                
                <div class="card-body">
                  <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', !empty($fdata->title) ? $fdata->title : null, ['id' => 'title', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Title']) }}
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>                  
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
                    {{ Form::label('sort_by', 'Position') }}
                    {{ Form::number('sort_by', !empty($fdata->sort_by) ? $fdata->sort_by : null, ['id' => 'sort_by', 'class' => $errors->has('sort_by') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Title']) }}
                    @error('sort_by')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>                  
                                  
                 
                  <div class="form-group">
                       
                        {{ Form::checkbox('is_important', '1', (!empty($fdata->is_important) ? $fdata->is_important : false), ['id' => 'is_important']) }}
                        {{ Form::label('is_important', 'Is Important?') }}
                      </div>
                 
                  <div class="form-group">
                  
                        {{ Form::checkbox('is_character', '1', (!empty($fdata->is_character) ? $fdata->is_character : false), ['id' => 'is_character']) }}
                        {{ Form::label('is_character', 'Is Character?') }}
                  </div>
                 

                  {{-- <div class="form-group">
                    <div
                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        {{ Form::checkbox('is_active', 'Yes', false, ['class' => 'custom-control-input', 'id' => 'is_active', 'checked' => !empty($fdata->is_active) && $fdata->is_active == 'Yes' ? true : false]) }}
                        <label class="custom-control-label" for="is_active"> Is Active ?</label>
                    </div>
                </div> --}}
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {{ Form::close() }}
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
      </div>
    </section>
    <!-- form start --> 
  </div>

@endsection




