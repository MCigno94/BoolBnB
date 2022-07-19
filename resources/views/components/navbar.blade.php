<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm px-md-5 m-0 py-2">
    <div class="container-fluid">
        
        <!-- LOGO -->
        <a class="navbar-brand m-0" href="{{ url('/') }}">
            <div class="logo d-flex align-items-center text-danger fw-bold py-2 gap-2">
                <img src="{{asset('../../img/logo.png')}}" alt="">
                <div>BoolBnB</div>
            </div>
        </a>

        <!-- MENU HAMBURGER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarNav" style="flex-grow: 0 !important;">
            <ul class="navbar-nav">
                <!-- ========== Start HOME ========== -->
                <li class="nav-item px-1 px-md-3">
                    <a class="nav-link" href="http://127.0.0.1:8000">Home</a>
                </li>
                <!-- ========== End HOME ========== -->

                <!-- ========== Start SEARCH ========== -->
                <li class="nav-item px-1 px-md-3">
                    <a class="nav-link" href="#">Search</a>
                </li>
                <!-- ========== End SEARCH ========== -->

                <!-- ========== Start AUTENTICATION ========== -->
                <li class="nav-item px-1">
                    @guest
                    <div class="d-md-flex ps-md-5">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </div>
                    @else
                    <li class="nav-item dropdown d-flex gap-1 px-1 ps-md-3">
                            <a href="{{ route('user.apartments.index') }}" class="nav-link fw-bold pe-2">{{ Auth::user()->name }}</a>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </li>
                <!-- ========== End AUTENTICATION ========== -->
            </ul>
        </div>
    </div>
</nav>