@extends('frontend.master')
@push('cssOnTop')
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid d-flex header-banner">
            <div class="align-self-center flex-fill justify-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb a_cbsd bg-transparent">
                      <li class="breadcrumb-item"><a href="{{route('frontend.media')}}">Movie</a></li>
                      <li class="breadcrumb-item shapla_brdcmp text-white-50 active" aria-current="page">{{$mdata->name? $mdata->name : null}}</li>
                    </ol>
                </nav>
                <h1 class="text-white text-center">{{$mdata->name? $mdata->name : null}}</h1>
            </div>
        </div>
        <div class=" col-lg-12 subheader_menu">
            <div class="subheader_menu_left">
            </div>
            <ul class="d-md-flex subheader_menu_right">
                <li>
                    <a class="scrollTo" href="#watch_it"> Watch It</a>
                </li>
                <li>
                    <a  class="scrollTo" href="#gallery_part"> Gallery</a>
                </li>
                <li>
                    <a  class="scrollTo" href="{{route('frontend.full_cast_crew',$mdata->slug)}}">Full cast and crew</a>
                </li>
            </ul>
        </div>
       <div class="container-fluid">
        <div class="row bg_1e1e1e">
            <div class="col-md-3 p-0">
                {{-- <img class=" img_detail  p-sm-1" src="{{asset($mdata->potraitimage)}}" alt="" style="width: 100%; margin-left: 10px; "> --}}
                <img class="img_detail p-sm-1 lazyImages" src="{{asset($mdata->potraitimage)}}" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="" style="width: 100%; margin-left: 10px;">
            </div>
            <div class="p-2 col-md-6">
                <h3 class="mb-2 text-white pl-3 pr-3">About</h3>
                <p class="mb-2 p-3 text-white-50">{!! Str::limit(nl2br(e($mdata->description)), 2500) !!}</p>
            </div>
            
            <div class="col-md-3 bg_171717">
                <div class="dark card bg-transparent">
                    <div class="card-header">
                        <h4 class="text-white">Movie Info</h4>
                    </div>
                    <div class="card-body pt-0 px-2">
                        <ul class="list-group list-group-flush">
                            @if($mdata->parent_id)
                            <li class="list-group-item bg-transparent" >
                                <h5 class="text-secondary">Title</h5>
                                <p><a href="{{route('frontend.view',$mdata->media->slug)}}">{{$mdata->media->name}}</a></p>
                            </li>
                            @endif
                            <li class="list-group-item bg-transparent">
                                <h5 class="text-secondary">Movie Release Date</h5>
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
                                    @foreach($rparent as $r)
                                        <a href="{{url('/profile/')}}/{{$r->slug}}">{{$r->name}}</a>@if( !$loop->last),@endif
                                    @endforeach
                                </li>
                            @endforeach

                            @if($song->count() > 0)
                            <li class="list-group-item bg-transparent text-light">
                                <h5 class="text-secondary">Songs</h5>
                                    <div class="col-lg-12">
                                        <div class="row">
                                        @foreach($song as $key => $list)
                                            <div class="col-6 pb-3">
                                                <a href="{{route('frontend.song', $list->slug)}}"><img class="img-fluid" src="{{asset($list->landscapeimage)}}">{{$list->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
       </div>
         @if($mdata->link)
        <div class="container my-5"  id="watch_it">
            <div class="row">
                <div class="col-lg-9 mb-5">
                        <div class=" mt-3 mb-3">
                            <h3 class="section__title">Movie Trailer</h3>
                        </div>
                    <iframe class="embed-responsive-item embed-responsive embed-responsive-16by9" width="auto" height="470px" src="{{$mdata->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-lg-3">
                        <div class=" mt-3 mb-3">
                            <h3 class="section__title">Watch It</h3>
                        </div>
                        <div>
                        <a  href="{{$mdata->cinebazurl}}">
                            @if($mdata->cinebazurl)
                                <img  src="{{asset('img/cinebaz-white-240x75.png')}}" alt="">
                                @else
                                <p class="coming_test">Coming soon on Cinebaz!</p>
                            @endif
                        </a>
                        </div>
                </div>
            </div>
        </div>
         @endif 
         @if(isset($mediaimage->image))
            <div class="container-fluid bg_0e0e0e" id="gallery_part">
                <div class="gallery_carousel">
                    <div class="">
                        <h3 class="section__title text-white ml-0">Gallery</h3>
                    </div>
                    <div class="gallery_carousel_inner">
                        <div class="slider-for">
                            @isset($mediaimage)
                                @foreach (json_decode($mediaimage->image) as $item)
                                    <div class="single_testmonial">
                                        <img src="{{asset('uploads/mediaimage/'.$item)}}" height="150">
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <div>
                        <div class="slider-nav">
                            @isset($mediaimage)
                                @foreach (json_decode($mediaimage->image) as $item)
                                    <div class="item">
                                        <img src="{{asset('uploads/mediaimage/'.$item)}}" height="150">
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        @endif 
    </div>
@endsection

@push('jsOnBottom')
    <script src="https://unpkg.com/vue@latest"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="https://unpkg.com/vue-slick-carousel"></script>
    <script src="{{asset('js/slick.min.js')}}"></script> 
@endpush

@push('customjs')
    <script>
        let msg = {!!json_encode($mdata->cinebazurl)!!};
        new Vue({
            el: '#app',
            data: {
                msg: msg,
                readMoreActivated: false
            },
            methods: {
            }
        })
        $('.slider-for').slick({
            dots: false,
            arrows: false,
            infinite: false,
            fade: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.slider-nav',
            centerMode: true,
        });
        
        $('.slider-nav').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
            focusOnSelect: true,
            variableWidth: true,
            centerMode: true,
        });
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.srcset = lazyImage.dataset.srcset;
                    lazyImage.classList.remove("lazy");
                    lazyImageObserver.unobserve(lazyImage);
                    }
                });
                });

                lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Possibly fall back to event handlers here
            }
            });
    </script>
    <script id="slicknav">
        var menu = $('ul#mobile-menu');
        if (menu.length) {
            menu.slicknav({
                prependTo: ".mobile_menu",
                closedSymbol: '<i class="ti-angle-down"></i>',
                openedSymbol: '<i class="ti-angle-up"></i>'
            });
        };
    </script>
@endpush
@push('extraCss')
    <style>
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
        .shapla_brdcmp::before {
            display: inline-block;
            padding-right: .5rem;
            color: #dae0e4 !important;
            content: "/";
        }
        .a_cb{
            margin-top: -48px;
        }
    </style>
@endpush