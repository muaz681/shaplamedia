<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @include('frontend.layouts.seo')


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/slick.css')}}"> --}}

    {{-- <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"> --}}

    {{-- <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.css')}}"> --}}

    {{-- <link rel="stylesheet" href="{{asset('css/slick.css')}}"> --}}
    
    @stack('cssOnTop')   
    @stack('jsOnTop')   

    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/newstyle.css')}}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" /> --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QX8RWTGY6K"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QX8RWTGY6K');
    </script>

    

</head>

<body>

    <!-- HEADER::START -->
    @include('frontend.layouts.header')
    <!--/ HEADER::END -->

    <!-- BANNER::START  -->
    {{-- @include('frontend.layouts.banner',['slider'=>$slider]) --}}
    <!-- BANNER::END  -->

    <!-- UP_ICON  -->
    <!-- {{-- <div id="back-top" style=""> --}} -->
    <div id="app" style="">
        @yield('content')
        <a title="Go to Top" href="#" class="gototop">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    @include('frontend.layouts.footer')

    <!--/ UP_ICON -->

    <!--ALL JS SCRIPTS -->
    <script src="{{asset('js/vendor/jquery-3.4.1.min.js')}}"></script>
     <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    
    {{-- <script src="{{asset('js/vendor/popper.min.js')}}"></script> --}}


    {{-- <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script> --}}
    {{-- <script src="{{asset('js/slick.min.js')}}"></script>  --}}
    {{-- <script src="{{asset('js/owl.carousel.min.js')}}"></script> --}}

     {{-- <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script> --}}

    {{-- <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/nice-select.min.js')}}"></script>
    <script src="{{asset('js/barfiller.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('js/parallax.js')}}"></script>
    <script src="https://unpkg.com/vue@latest"></script>
    <script src="https://unpkg.com/vue-slick-carousel"></script> --}}
    
    <!-- MAIN JS   -->
    <script src="{{asset('js/main.js')}}"></script>

    @stack('jsOnBottom')
    @stack('customjs')

    @stack('extraCss')
</body>

</html>