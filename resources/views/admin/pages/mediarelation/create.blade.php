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

<div class="card-body">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Relation</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" action="{{route('media-relation.add')}}" method="POST">
            @csrf
          <div class="card-body">
          
                              
            <div class="form-group">
              <label for="exampleInputEmail1">Media Name</label>
              <input type="text" name="movie_id" class="form-control" id="exampleInputEmail1" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">People </label>
              <input type="date" name="people_id" class="form-control" id="exampleInputEmail1" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Role</label>
              <input type="text" name="role_id" class="form-control" id="exampleInputEmail1" placeholder="Enter ...">
            </div>
  
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Designation</label>
              <input type="text" name="designation" class="form-control" id="exampleInputEmail1" placeholder="Enter ...">
            </div>
          
          
          
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
  </div>

   
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

</script>
@endsection
