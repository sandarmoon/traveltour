<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block " data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="index.html">
        {{-- <img class="d-inline-block" src="assets/img/gallery/logo.png" width="50" alt="logo" /> --}}
        <span class="fw-bold text-primary ms-2">Advacen Agency</span></a>

      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

      <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0 float-right" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto pt-2 pt-lg-0 font-base">
          <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="{{route('frontend.index')}}"><span class="nav-link-text">Home </span></a></li>

          <li class="nav-item px-2"><a class="nav-link" href="#flights"> <span class="nav-link-text">About</span></a></li>

          {{-- <li class="nav-item px-2"><a class="nav-link" href="#hotels"> <span class="nav-link-icon text-800 me-1 fas fa-hotel"></span><span class="nav-link-text">Hotels</span></a></li> --}}

         {{--  <li class="nav-item px-2"><a class="nav-link" href="#activities"><span class="nav-link-icon text-800 me-1 fas fa-bolt"></span><span class="nav-link-text">Activities</span></a></li> --}}

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="nav-link-text">{{(Auth::check())? Auth::user()->name : 'SignUp/Login'}}</span></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              
                @if(Auth::check())
                <li><a class="dropdown-item" href="{{route('bookinghistory')}}">
                    <span class="nav-link-text">Booking History</span></a></li>
                <li> <a class="dropdown-item preview-item" href="route('logout')" class="d-inline" 
                            onclick="event.preventDefault();
                                        document.getElementById('logoutform').closest('form').submit();">
                            

                            
                                       <span class="nav-link-text">  Log out </span>
                                        

                            <form method="POST" id="logoutform" class="d-inline" action="{{ route('logout') }}">
                                        @csrf

                                        
                                    </form>
                        </a></li>

                    


                @else
                <li><a class="dropdown-item" href="{{route('login')}}"><span class="nav-link-text">Login</span></a></li>
                <li><a class="dropdown-item" href="{{route('register')}}"><span class="nav-link-text">SignUp</span></a></li>
                
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-header"><h5 class="nav-link-text my-0">Partnership</h5></a></li>
                
                
                <li><a class="dropdown-item" href="{{route('company.create.partner',2)}}"><span class="nav-link-text">Car Partnership</span></a></li>
                <li><a class="dropdown-item" href="{{route('company.create.partner',1)}}"><span class="nav-link-text">Hotel Partnership</span></a></li>
                @endif
            </ul>
        </li>
        
        </ul>
        <form class="d-flex">
            <button class="btn btn-voyage-outline text-primary" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Cart
                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
        </form>
      </div>
    </div>
  </nav>