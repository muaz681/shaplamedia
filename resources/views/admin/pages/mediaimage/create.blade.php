@extends('admin.layouts.master')

@section('content')

  <div class="content-wrapper">
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
    {{-- !-- Content Header (Page header) --> --}}
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Media Gallery</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Gallery Image</li>
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
                <h3 class="card-title">Add Images</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{ Form::open(['method' => 'POST', 'route' => 'mediaimage.store', 'enctype' => 'multipart/form-data']) }}
              {{-- <form role="form" enctype="multipart/form-data" action="{{route('mediaimage.add')}}" method="POST"> --}}
                {{-- @csrf --}}
                {{ Form::hidden('id', !empty($media->id) ? $media->id : null) }}
                <div class="card-body">
                  <div class="form-group">
                    {{ Form::label('media', 'Select Media') }}
                    {{-- {{$media->media? $media->media->id :null}} --}}
                    {{ Form::select('media_id', getdistMediaArr($media->id), $media && $media->media ? $media->media->id : null, ['class' => $errors->has('media_id') ? 'form-control myselect2  is-invalid' : 'form-control myselect2','placeholder' => 'Select a Media']) }}
                    @error('media_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  {!! Form::label('image', 'Image') !!}
                  @isset($media->image)
                    <div class="row">
                      <div class="card col-2 p-3" v-for="(image, i) in images" :key="i">
                        <figure>
                          <img :src="baseURL+ '/uploads/mediaimage/' + image" height="150px" width="150px" :alt="image">
                          <figcaption v-text="image"></figcaption>
                        </figure>
                        <input type="hidden" :name="'old_image['+i+']'" :value="image">
                        <div class="col-3">
                          <button @click="removeN(i)" class="btn btn-danger" type="button">Remove </button>
                        </div>
                      </div>
                    </div>
                    
                  @endisset
                  <div class="input-group control-group increment" v-for="(input,i) in inputs">
                    {!! Form::file('image[]',  ['class' => 'form-control']) !!}
                    <div class="input-group-append">
                      <button @click="addInput(i)" class="btn btn-primary" type="button" v-if="i < 1">+Add</button>
                      <button @click="remove(i)" class="btn btn-danger" type="button" v-else>-Remove </button>
                    </div>
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
                {{ Form::close() }}
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
      </div>
    </section>
  </div>

@endsection

@push('customjs')

<script type="text/javascript">

  $(document).ready(function() {
    $(".btn-success").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
        $(this).parents(".control-group").remove();
    });

  });

  // Vue.component('v-select', VueSelect.VueSelect);

  let images =  {!! $media->image !!};
  let baseURL = '{!! URL::to('/') !!}';
  // let images =  ["augost 751020x1560.jpg","Tungi parar mia vai_1020x1560.jpg","Pagoler moto valobashi_1020x1560.jpg","Bidya-Sinha-Saha-Mim.jpg","ami neta hobo thumb.jpg","simon.jpg"];
  new Vue({
    el: '#app',
    data: {
      // count: 0,
      baseURL: baseURL,
      images: images,
      inputs: [{

      }],
    },
    methods: {
	    addInput() {
	      this.inputs.push({

	      });
	    },
      remove(i) {
        this.inputs.splice(i, 1);
	    },
      editremove(j) {
        this.images.splice(j, 1);
	    },
      removeN(i) {
        this.images.splice(i, 1);
	    }
	  }
  })

</script>
@endpush
