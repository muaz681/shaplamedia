@extends('frontend.master')

@section('content')
     <div class="first_bread1 rmt" style="margin-top: 69px;"> 
          <nav aria-label="breadcrumb">
               <ol class="breadcrumb  mt-2 ml-n4 bg-transparent">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item shapla_brdcmp1 active" aria-current="page">Songs</li>
               </ol>
          </nav>
     </div>
     @include('frontend.layouts.songs',['song'=>$song])
  
@endsection