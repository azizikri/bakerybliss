<header class="ul-header">
    <div class="header-top-bg-wrapper">
        <div class="ul-header-top">
            <div class="ul-header-container">
                <div class="ul-header-top-left">
                    <div class="ul-header-contact-infos">
                        <span class="ul-header-contact-info"><i class="flaticon-location-pin colored"></i> Jl. Vila Dago
                            Raya, Pd. Benda, Tangerang, Kota Tangerang Selatan</span>
                    </div>
                </div>

                <div class="ul-header-top-right">
                    <div class="ul-header-auth-options">
                        @guest
                            <i class="flaticon-user"></i>
                            <a href="{{ route('login') }}">Login</a>
                            <span>/</span>
                            <a href="{{ route('register') }}">Register</a>
                        @endguest
                        @auth
                            <i class="flaticon-user"></i>
                            <a href="{{ route('profile.edit') }}">Profile</a>
                            <span>/</span>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom-bg-wrapper to-be-sticky">
        <div class="ul-header-bottom">
            <div class="ul-header-bottom-wrapper ul-header-container">
                <div class="logo-container">
                    <a href="{{ route('home') }}" class="d-inline-block"><img src="{{ asset('user/img/logo.png') }}"
                            alt="logo" class="logo" /></a>
                </div>

                <!-- header nav -->
                <div class="ul-header-nav-wrapper">
                    <div class="to-go-to-sidebar-in-mobile">
                        <nav class="ul-header-nav">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('catalog.index') }}">Catalog</a>
                            <a href="{{ route('about-us') }}">About Us</a>
                            <a href="{{ route('contact') }}">Contact</a>
                        </nav>
                    </div>
                </div>

                <!-- actions -->
                <div class="ul-header-actions">
                    <a href="{{ route('cart.index') }}" class="nav-link d-flex">
                        <i class="flaticon-cart"></i>
                        <span class="cart-count">{{ count(session('cart', [])) }}</span>
                    </a>
                    <a href="{{ route('catalog.index') }}" class="ul-btn d-sm-inline-flex d-none">order now <i
                            class="flaticon-right"></i></a>
                    <button class="ul-header-sidebar-opener d-lg-none d-inline-flex">
                        <i class="flaticon-menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
