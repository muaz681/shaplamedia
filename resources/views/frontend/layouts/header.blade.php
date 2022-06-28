<header style=" background-color: #0e0e0e; ">
    <div id="sticky-header" class="header_area ">
      <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="header__left">
          <div class="logo_img">
              <a href="{{route('frontend.home')}}">
                  <img class="logos" src="{{asset('img/shapla/logo.png')}}" style="" alt="shapla media">
              </a>
          </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse main_menu text-left  " id="navbarSupportedContent">   
          <ul class="navbar-nav mr-auto" id="mobile-menu">
            <li class="nav-item ">
              <a  href="{{route('frontend.media')}}">
                  <span>Movies</span>
              </a>
            </li>
            <li class="nav-item ">
              <a  href="{{route('frontend.songspages')}}">
                  <span>Songs</span>
              </a>
            </li>         
            <li class="nav-item">
              <a href="{{route('frontend.about')}}">
                  <span>About</span>
              </a>
           </li>
            {{-- <li class="nav-item">
              <a href="{{route('frontend.team')}}">
                  <span>Team</span>
              </a>
           </li>          --}}
            <li class="nav-item">
              <a href="{{route('frontend.contact')}}">
                  <span>Contact Us</span>
              </a>
            </li>          
          </ul>
          <ul>
            <li class="nav-item" >
              <a href="https://cinebaz.com/" class="">
                  <span>Visit Cinebaz</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
</header>