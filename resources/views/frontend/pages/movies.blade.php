@extends('frontend.master')

@section('content')
  <!-- BANNER::START  -->
  {{-- @include('frontend.layouts.banner',['slider'=>$slider]) --}}
  <!-- BANNER::END  -->
  <!-- movie_list_area ::start  -->
  <br><br>
  @include('frontend.layouts.theatre',['theaters'=>$theaters])

  

  @endsection




