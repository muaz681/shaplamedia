@extends('frontend.master')
@section('content')
    <div class="content">
        <div class="container-fluid d-flex header-banner">
            <div class="align-self-center flex-fill justify-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb a_cbsd bg-transparent">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item shapla_brdcmp "><a href="#">Song</a></li>
                      <li class="breadcrumb-item shapla_brdcmp text-white-50 active" aria-current="page">{{$mdata->name? $mdata->name : null}}</li>
                    </ol>
                </nav>
                <h1 class="text-white text-center">{{$mdata->name? $mdata->name : null}}</h1>
            </div>
        </div>
        <div class="container-fluid bg_1A1A1A">
            <div class="row p-5 rec_1">
                <div class=" col-md-6">
                    <iframe style="width:100%" height="450" src="{{$mdata->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="row  mx-0">
                        <div class="col-md-4 song-img">
                            <a href="{{route('frontend.view',$mdata->media->slug)}}"><img class="lazyImages landscape" src="{{asset($mdata->media->potraitimage)}}" alt="{{$mdata->media->slug}}" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" style="width: 100%; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ,color: #ffffff;"></a>
                        </div>
                        <div class=" col-md-8">
                            <div class="dark p-3" >
                                <div class="mb-2 text-secondary">About this Movie</div>
                                <h3 class="mb-2 text-white"><a href="{{route('frontend.view',$mdata->media->slug)}}">{{$mdata->media->name}}</a></h3>
                                <p class="mb-2 text-white-50">{!! Str::limit(nl2br(e($mdata->media->description)), 400) !!}<a href="{{route('frontend.view',$mdata->media->slug)}}">Read more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dark p-3" >
                        <h2 class="text-white">Lyrics</h2>
                        <p class="text-center text-white-50">{!! nl2br(e($mdata->description)) !!}</p>
                    </div>
                </div>
                <div class="col-md-3 bg_171717">
                    <div class="dark">
                        <ul class="list-group list-group-flush">
                            @if($mdata->parent_id)
                            <li class="list-group-item bg-transparent">
                                <h5 class="text-secondary">From Movie</h5>
                                <p><a href="{{route('frontend.view',$mdata->media->slug)}}">{{$mdata->media->name}}</a></p>
                            </li>
                            @endif
                            <li class="list-group-item bg-transparent">
                                <h5 class="text-secondary"> Song Release Date</h5>
                                <p class="text-white">{{ ($mdata->release_date)?  date('d-F-Y', strtotime($mdata->release_date)): 'Upcoming ' }}</p>
                            </li>
                            @if($mdata->ratings)
                            <li class="list-group-item bg-transparent">
                                <h5 class="text-secondary">Age Rating</h5>
                                <p>{{$mdata->ratings}}</p>
                            </li>
                            @endif
                            
                            @foreach($data['roles'] as $key => $rparent)
                                <li class="list-group-item bg-transparent text-light">
                                    <h5 class="text-secondary">{{$key}}</h5>
                                    @foreach($rparent as $k => $r)
                                       <a href="{{url('/profile/')}}/{{$r->slug}}">{{$r->name}}</a>@if( !$loop->last),@endif
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('extraCss')
    <style>
        

        .a_cb{
            margin-top: -48px;
        }

        .shapla_brdcmp::before {
        display: inline-block;
        padding-right: .5rem;
        color: #dae0e4 !important;
        content: "/";
    }

        .header-banner {
            position: relative;
            height: 200px;
        }
        .header-banner:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            background: linear-gradient(45deg, rgb(111 85 9 / 36%) 0%,rgb(2 2 2 / 81%) 100%);
            left: -5%;
            width: 105%;
            height: 120%;
            z-index: -1;
        }
        .header-banner:after {
            content: '';
            height: 200px;
            background-image: url("{{asset($mdata->landscapeimage ?? $mdata->potraitimage)}}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 34%;
            position: absolute;
            width: 105%;
            height: 120%;
            left: -5%;
            filter: blur(5px);
            z-index: -2;
        }
    </style>
@endpush