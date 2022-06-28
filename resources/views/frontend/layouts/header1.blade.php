<header>
    <div id="sticky-header" class="header_area">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" style=" margin-top: 10px; margin-bottom: 10px;">
                    <div class="header__wrapper">
                        <!-- header__left__start  -->
                        
                        <div class="header__left">
                            <div class="logo_img">
                                <a href="{{route('frontend.home')}}">
                                    {{-- <svg focusable="false" viewBox="0 0 25 32" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.796 13.65c-.698 0-1.332.268-3.286 1.67v7.546c3.387-3.806 4.352-6.41 4.352-7.746-.004-.935-.435-1.47-1.066-1.47zm.266-5.008c0-1.34-1.527-2.438-3.552-2.571v6.978c2.555-1.502 3.552-3.008 3.552-4.407zm6.014-2.961c-.033-.134-.067-.184-.134-.2l-2.394-.636-.332-1.369c-.017-.067-.034-.117-.1-.133l-2.458-.668-.299-1.303a.183.183 0 00-.133-.167L12.843.015a.855.855 0 00-.316 0l-6.385 1.19a.183.183 0 00-.133.167l-.3 1.303-2.457.667c-.067.016-.083.066-.1.133l-.332 1.37-2.388.635c-.066.017-.1.067-.133.2A17.246 17.246 0 000 8.92c0 9.62 4.983 17.97 12.423 22.946a.332.332 0 00.533 0C20.396 26.89 25.38 18.539 25.38 8.921a17.32 17.32 0 00-.304-3.24zM11.753 27.44c0 .068-.067.1-.133.034-1.827-2.104-3.055-4.675-3.886-7.48l-1.262.804c-.332.234-.597.134-.8-.233-1.693-3.006-2.789-7.949-2.888-11.42a.603.603 0 01.166-.434 15.78 15.78 0 011.46-1.536c.1-.1.2-.034.2.133 0 4.274.73 8.247 1.893 10.853.1.2.2.2.333.1l.365-.234c-.698-3.106-1.096-7.246-.997-12.021 0-.168.034-.234.133-.3.51-.32 1.042-.599 1.594-.836.166-.067.2-.033.2.1-.095 6.945.472 11.752 1.699 15.592.033.1.132.066.132-.034-.067-1.402-.067-2.637-.067-4.14L9.83 4.4c0-.133.033-.2.166-.233.546-.136 1.1-.237 1.66-.301a.089.089 0 01.1.1l-.003 23.475zm1.993.034c-.067.067-.133.034-.133-.033V3.968a.09.09 0 01.099-.1c4.45.3 7.306 2.17 7.306 4.875a4.548 4.548 0 01-1.162 3.036c1.46.401 2.026 1.504 2.026 2.973.002 2.605-1.89 6.913-8.134 12.723h-.002z"
                                            fill="#FFF" fill-rule="nonzero"></path>
                                    </svg> --}}
                                    <img class="logos" src="{{asset('img/shapla/logo.png')}}" style=""; alt="shapla media">
                                </a>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                        <!-- header__left__start  -->

                        <!-- main_menu_start  -->
                        <div class="main_menu text-right d-none d-lg-block " id="navbarSupportedContent">
                            <nav>
                                <ul id="mobile-menu" class="">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{route('frontend.media')}}">
                                            <span>Movies</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('frontend.about')}}">
                                            <span>About</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('frontend.contact')}}">
                                            <span>Contact Us</span>
                                        </a>
                                    </li>    
                                   
                                    <li class="nav-item right" >
                                        <a href="https://cinebaz.com/" class="">
                                            {{-- style="margin-left: 787px;" --}}
                                            {{-- <img class="img-fluid logo" src="{{asset('img/shapla/cinebaz-logo.png')}}" style="height:30px;width:30px"; alt="shapla media"> --}}
                                            <span>Visit Cinebaz</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</header>