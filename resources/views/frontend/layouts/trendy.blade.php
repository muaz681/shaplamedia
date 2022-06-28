<div class="container-fluid">
    <div class="col-12 pl-0 mt-4">
        <h3 class="text-white">Released Movies</h3>
    </div>
    <div class="row no-gutters oddPadding">
        @foreach ($trending->medias as $list) 
        @if($list->media_type == "movie")
            <div class="col-6 col-lg-2 mt-2">
                <a class="d-block" href="{{route('frontend.view',$list->slug)}}">
                    <img class="p-sm-2 lazyImages border_radius_small" src="{{asset($list->potraitimage)}}" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="" style="width: 100%;">
                </a>
                <div class="mt-2 ml-1">
                    @foreach ( $list->categories as $key=>$item )
                        <span class="cat_list">{{$item->name}}</span>
                    @endforeach
                    <h3>
                        <a class="h6 text-white" href="{{route('frontend.view',$list->slug)}}">
                            {{$list->name}}
                        </a>
                    </h3>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>

