@extends('frontend.master')
@section('content')
    <div class="container-fluid d-flex header-banner">
        <div class="align-self-center flex-fill justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb a_cb bg-transparent">
                <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">Home</a></li>
                <li class="breadcrumb-item  shapla_brdcmp text-white-50 active" aria-current="page">About us</li>
                </ol>
            </nav>
            <h1 class="text-white text-center ">About us</h1>
        </div>
    </div>
    <div class="container mt-3 bg_1e1e1e">
        <div class="row mt-80 mb-80">       
            <div class="col-lg-7 mt-5">
                <h3 class="about_title ">About Us</h3>
                <p class="text-white text-justify">
                    Shaplamedia is a cinema production house as well as exporter & importer of bangla contents(such as Movies, TV shows, entertainment products). It was established in 2018 by Md. Selim Khan(Chairman of SHaplamedia). Shaplemedia is pledged to produce quality contents.
                </p>
            </div>
            <div class="col-lg-5 mt-5" >
                 <img class="img_detail  lazyImages landscape" src="img/aboutus.jpg" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
            </div>  
        </div> 
        <div class="row mt-80 mb-80">
            <div class="col-lg-4" >
                 <img class="img_detail  lazyImages landscape" src="img/chair.jpg" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
            </div>
            <div class="col-lg-8">
                    <h3 class="about_title  mt-2">Message From Chairman</h3>
                    <p class="text-white text-justify">
                        As a visionary film producer I want to take Bangladeshi film industry at an international level. Where people around the world will enjoy Bangla contents. I also gladly invite new artists and directors for new and innovative works. Good and quality content is always my concern.
                    </p>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="about_title">Our Investments</h3>
            <div class="row mt-80 mb-80">
                <div class="col-lg-4 p-2">
                    <img class="lazyImages landscape" src="img/voicetv-logo.png" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
                </div>
                <div class="col-lg-4 p-2">
                     <img class="lazyImages landscape" src="img/cinebaz-white-240x75.png" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
                </div>
                <div class="col-lg-4 p-2">
                     <img class="news-img lazyImages landscape" src="img/sp.png" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
                </div>
            </div> 
        </div> 
        <div class="row mt-80 mb-80">
            <div class="col-lg-4" >
                 <img class="img_detail  lazyImages landscape" src="img/mission.png" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
            </div>
            <div class="col-lg-8">
                    <h3 class="about_title ">Our Mission</h3>
                    <p class="text-white text-justify h6">
                        Movies always moves our emotions and feelings. So, we make movies with new and innovative iedeas.
                        We also welcome new faces and talents for the industry.
                    </p>
            </div>                      
        </div>
        <div class="row mt-80 mb-80">
            <div class="col-lg-8">
                <h3 class="about_title ">Our Vision</h1>
                <p class="text-white text-justify">
                    Shaplamedia aterted with a vision of making 100 films. Our vision is to take bangladeshi film 
                    in a place where everyone would praise bangla film industry
                </p>
            </div>
            <div class="col-lg-4 mb-5">
                <img class="img_detail  lazyImages landscape" src="img/vision(2).png" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="">
            </div>
        </div>
    </div>
@endsection
@push('extraCss')
    <style>
.about_title {
    font-size: 2.5rem;
    /* padding-left: 1.375rem; */
    /* border-left: 0.1rem solid rgba(142, 142, 142, 0.8); */
    font-size: 1.875rem;
    font-weight: 600;
    line-height: 1;
    text-transform: uppercase;
    color:white;
    margin-bottom: 33px;
    /* margin-left: 17px; */
}
.news-img {
    width: auto;
    max-height: 75px;
    text-align: center;
    margin-left:50px;
    
}

    .a_cb{
        margin-top: 50px;
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
        background-image: url("{{asset('img/shapla/bd-img.jpg')}}");
        background-position: 50% 50%;
        position: absolute;
        width: 105%;
        height: 120%;
        left: -5%;
        filter: blur(5px);
        z-index: -2;
    }
</style>
@endpush
