@extends('frontend.master')

@section('content')
  <!-- BANNER::START  -->
  {{-- @include('frontend.layouts.banner',['slider'=>$slider]) --}}
  <!-- BANNER::END  -->
  <!-- movie_list_area ::start  -->
  {{-- @include('frontend.layouts.allmovies',['trendy'=>$trendy]) --}}
  @include('frontend.layouts.allmovies',['media'=>$new])
  <!-- movie_list_area ::end  -->
  <!-- movie_list_area ::start  -->
  {{-- @include('frontend.layouts.movie') --}}
  <!-- movie_list_area ::end  -->
  <!-- BANNER::START  -->
  {{-- @include('frontend.layouts.banner',['slider'=>$slider]) --}}
  <!-- BANNER::END  -->

 


@endsection