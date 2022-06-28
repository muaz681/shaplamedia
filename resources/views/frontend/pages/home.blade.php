@extends('frontend.master')
@push('cssOnTop')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endpush

@section('content')

  <!-- BANNER::START  -->
  @include('frontend.layouts.banner',['slider'=>$slider])
  <!-- BANNER::END  -->

  <!-- movie_list_area ::start  -->
  @include('frontend.layouts.new',['media'=>$new])

  {{-- @include('frontend.layouts.movie') --}}

  @include('frontend.layouts.trendy',['trending'=>$trending])
 
  @if(count($drama) > 0)
  @include('frontend.layouts.drama')
  @endif
  
  @include('frontend.layouts.songs',['song'=>$song])

  

@endsection
@push('jsOnBottom')
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endpush

@push('customjs') 
 <script>    
   $('.banner_carousel').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: true,
        dots: true,
        autoplayHoverPause: true,
        autoplaySpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 1
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
    
</script> 
  
@endpush