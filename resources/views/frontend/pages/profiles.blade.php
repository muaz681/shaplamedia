@extends('frontend.master')
{{-- @push('cssOnTop')
   <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endpush --}}
@section('content')
<div class="container-fluid d-flex header-banner">
	<div class="align-self-center flex-fill justify-content-center">
		<h1 class="text-white text-center h_profile">Profile</h1>
	</div>
</div>
	<section class=""> 			
        <div class="container">
			<div class="row">			
				<div class="col-lg-8">
					<div class="card bg_1e1e1e">
						<div class="card-body">
						    <div class="">
								<h2 class="mb-3 pt-3 pb-3 text-white border-bottom border-dark">{{$info->name}}</h2>
								@if($info->image)
								     <img class="pr-2 pb-2 float-left w-25 h-50" src="{{asset($info->image)}}" alt="">
								@else
								     <img class="pr-2 pb-2 float-left w-25 h-50" src="{{asset('img/shapla/upcoming.jpeg')}}" alt="">	
								@endif

								<p class="text-justify text-white-50">
									{{Str::limit($info->description, 1200)}}	
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card bg_1e1e1e p-2">
						<div class="cord-body pt-3">
							<dl class="row px-2 pt-4">
								<dt class="col-sm-5 text-white">Born</dt>
								<dd class="col-sm-7 text-white-50">{{ ($info->dob)?  date('d-F-Y', strtotime($info->dob)): 'N/A ' }}</dd>

								<dt class="col-sm-5 text-white">Occupation</dt>
								<dd class="col-sm-7 text-white-50">
									@foreach ($info->roles as $key => $list)
										{{-- {{(($info->roles_id === 1)? ', ': ''). $list->name}}  --}}
										@if($list->title == 'Cast')
											<span class=" text-white-50">{{$info->gender ==='female' ? 'Actress' : 'Actor'}}</span>@if (!$loop->last),@endif
										@else
										 <span class="text-white-50">{{$list->title}}</span>@if (!$loop->last),@endif
										@endif
									@endforeach
								</dd>

								<dt class="col-sm-5 text-white">Years active</dt>
								<dd class="col-sm-7 text-white-50">
									{{ ($info->years_active)?  date('Y', strtotime($info->years_active)): 'N/A ' }} - {{ ($info->dead)?date('Y', strtotime($info->dead)):'present ' }}
								</dd>
							</dl>
							<div class="row">		
								<div class="col-lg-12 mb-4">
									<div class="row no-gutters">
										@foreach ($info->distinctMediaen as $key => $list)
											<div class="col-6 p-2">
												<a class="" href="{{route($list->media_type === 'song' ? 'frontend.song' : 'frontend.view',$list->slug)}}">
												@if($list->potraitimage)
													<img class="img-fluid rounded" src="{{asset($list->potraitimage)}}">
													@elseif($list->landscapeimage)
													<img class="img-fluid rounded" src="{{asset($list->landscapeimage)}}">
												@endif
												</a>
												 <a class="text-white" href="{{route('frontend.view',$list->slug)}}"> {{$list->name}} </a>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container mb-5" >
					<h2 class="text-white pt-2 pb-3 mb-3 mt-3 border-bottom border-dark">Works</h2>
					<div class="movie_lists profile_carousel owl-carousel bg_1e1e1e">
						@foreach ($info->distinctMedia as $key => $list)
						<div class="mb-5">
							<div class="">
								<a href="{{ route($list->media_type === 'song' ? 'frontend.song' : 'frontend.view',$list->slug)}}">
									<img class="pro_img" src="{{asset($list->potraitimage ? $list->potraitimage : $list->landscapeimage)}}" alt="{{$list->name}}">
								</a>
							</div>
							<div class="mb-2">
								<h4 class="h6 text-white mt-2 ml-2 text-wrap" style="max-width: {{$list->potraitimage ? '200' : '560'}}px;">
									<a href="{{ route($list->media_type === 'song' ? 'frontend.song' : 'frontend.view',$list->slug)}}">
										{{$list->name}}
									</a>
								</h4>
							</div>
						</div>
						@endforeach
					</div>
		        </div>			
			</div>
     	</div>
    </section>
@endsection
{{-- @push('customjs')
	 <script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endpush --}}
@push('extraCss')
<style>

    .header-banner {
        position: relative;
        height: 260px;
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
        background-image: url("{{asset($info->image)}}");
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
    .pro_img {
	    display: flex;
    }

    .pro_img{
	    width: auto;
	    height: 320px;

    }
</style>
@endpush
