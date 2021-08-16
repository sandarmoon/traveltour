<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5 ">
        <a class="navbar-brand" href="#!">Adventurer  Agency</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{(Auth::check())? Auth::user()->name : 'SignUp/Login'}}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       {{--  <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li> --}}
                        @if(Auth::check())
                        <li> <a class="dropdown-item preview-item" href="route('logout')" class="d-inline" 
                                    onclick="event.preventDefault();
                                                document.getElementById('logoutform').closest('form').submit();">
                                    

                                    
                                                Log out
                                                

                                    <form method="POST" id="logoutform" class="d-inline" action="{{ route('logout') }}">
                                                @csrf

                                                
                                            </form>
                                </a></li>

                        @else
                        <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                        <li><a class="dropdown-item" href="{{route('register')}}">SignUp</a></li>
                        <li><a class="dropdown-item" >Partnership</a></li>
                        <hr class="my-2">
                        <li><a class="dropdown-item" href="{{route('company.create.partner',2)}}">Car Partnership</a></li>
                        <li><a class="dropdown-item" href="{{route('company.create.partner',1)}}">Hotel Partnership</a></li>
                        @endif
                    </ul>
                </li>
                
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>