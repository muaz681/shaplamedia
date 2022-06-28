@extends('frontend.master')
@section('content')
    <div class="content">
        <div class="container-fluid d-flex header-banner">
            <div class="align-self-center flex-fill justify-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb a_cb bg-transparent">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item shapla_brdcmp"><a href="">{{$media->name? $media->name : null}}</a></li>
                      <li class="breadcrumb-item shapla_brdcmp text-white-50 active" aria-current="page">Full Cast and Crew</li>
                    </ol>
                </nav>
                <h1 class="text-white text-center">{{$media->name}}</h1>
                <h4 class="text-white text-center">Full Cast and Crew</h4>
            </div>
        </div>
        <div class="container table-responsive-sm">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card bg_0e0e0e">
                        <div class="row no-gutters">
                            <div class="col-lg-3">
                                <img class=" img-fluid rounded-start" src="{{asset($media->potraitimage)}}" alt="image" style="max-width: 100%; height: 300px; padding:10px; background-color: #1e1e1e;">
                            </div>
                            <div class="col-lg-9">
                                <div class="card-body">
                                    <h2 class="card-title"> </h2> 
                                    <h6 class="card-subtitle mb-2 text-muted">Description</h6>
                                    <p class="mb-2 text-justify text-white-50">{!! Str::limit(nl2br(e($media->description)), 400) !!}<a href="{{route('frontend.view',$media->slug)}}">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table  table-striped table-custom-border">
                        <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Roles</th> 
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $roles = [];
                            foreach ($media->roles as $role) {
                                $roles[$role->id]= $role;
                            }
                            $entities = [];
                            foreach ($media->entities as $key => $item) {
                                 $entities[$item->pivot->entity_id]['entities'] = $item;
                                 $entities[$item->pivot->entity_id]['roles'][] = $roles[$item->pivot->role_id];
                            }
                            @endphp
                            
                            @foreach ($entities as $key => $item) 
                            {{-- @dd($entities) --}}
                                <tr class='clickable-row' data-href='{{ route('frontend.profiles', $item['entities']->slug)}}'>
                                    <td><img src="{{asset($item['entities']->image)}}" alt="" style="max-width: 100%; height: 100px;"></td>
                                    <td class=" text-white">{{$item['entities']->name}}</td>
                                    <td class=" text-white ">
                                        @if($item['roles'])
                                         {{-- @dd($item['roles']) --}}
                                            @foreach ($item['roles'] as $k => $list)
                                                @if($list->title == 'Cast')
                                                    <span>{{$item['entities']->gender ==='female' ? 'Actress' : 'Actor'}}</span>@if (!$loop->last),@endif
                                                @else
                                                 <span>{{$list->title}}</span>@if (!$loop->last),@endif
                                                @endif
                                                {{-- <span class="text-white-50">{{$list->title}}</span>@if (!$loop->last),@endif --}}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><a href="{{ route('frontend.profiles', $item['entities']->slug)}}"><button type="button" class="btn btn-primary">View</button></a></td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                     <div class="card mb-3 bg_0e0e0e">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list a_c"><a class="nav-link" href="{{ route('frontend.view', $media->slug)}}">Details</a></li>
                                <li class="list a_c"><a class="nav-link" href="{{ route('frontend.view', $media->slug)}}#gallery_part">Gallery</a></li>
                                <li class="list a_c"><a class="nav-link" href= "{{ route('frontend.view', $media->slug)}}#watch_it">Trailer</a></li>
                                <li class="list  a_link active"><a class="nav-link" href="#">Full cast and crew</a></li>
                              </ul>
                         </div>
                    </div>
                    @if($media->relatedMedia->count())
                    <div class="card bg_0e0e0e">
                        <div class="card-header">
                             <h4>Related Movie List</h4>
                        </div>
                        <div class="card-body p-2">
                            @foreach ($media->relatedMedia as $list)
                                <div class="card bg_0e0e0e">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <img class=" img-fluid rounded-start" src="{{asset($list->potraitimage)}}" alt="image" style="max-width: 100%; height: 100px; padding: 2px;">
                                        </div>
                                        <div class="col-9">
                                            <div class="card-body">
                                                <a class="text-white" href="{{route('frontend.view',$list->slug)}}">{{$list->name}}</a>
                                                @foreach ($media->categories as $key => $itam)
                                                @if($list->categories == $itam->name)
                                                     <p class="text-white-50">{{$itam->id}}</p>
                                                     @endif
                                                @endforeach 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                        </div>
                    </div>
                    @endif
                </div>
            </div>
         </div>
    </div>

@endsection

@push('extraCss')
<style>
    .a_c a{
        color:#4697ea;
    }

    .a_link a{
        color:#dadada;
    }
    .a_cb li a{
        color:#ffffff;
    }
    .shapla_brdcmp::before {
    display: inline-block;
    padding-right: .5rem;
    color: #dae0e4 !important;
    content: "/";
}
    .card-text{
        font-size: 15px;
        line-height:20px;
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
        background-image: url("{{asset($media->landscapeimage ?? $media->potraitimage)}}");
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
    .clickable-row {
        cursor: pointer;
    }
</style>

@endpush

@push('customjs')
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endpush