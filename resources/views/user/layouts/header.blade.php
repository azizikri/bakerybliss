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
                            {{-- <div class="has-sub-menu">
                                <a role="button">Shop</a>

                                <div class="ul-header-submenu">
                                    <ul>
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="shop-details.html">Shop Details</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="has-sub-menu">
                                <a role="button">Pages</a>

                                <div class="ul-header-submenu">
                                    <ul>
                                        <li><a href="menu-1.html">Menu Style 1</a></li>
                                        <li><a href="menu-2.html">Menu Style 2</a></li>
                                        <li><a href="reservation.html">Reservation</a></li>
                                        <li><a href="services.html">Services</a></li>
                                        <li><a href="chef.html">Our Chef</a></li>
                                        <li><a href="gallery.html">Gallery</a></li>
                                        <li><a href="testimonials.html">Testimonials</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="has-sub-menu">
                                <a role="button">Blog</a>

                                <div class="ul-header-submenu">
                                    <ul>
                                        <li><a href="blog.html">Blogs</a></li>

                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </nav>
                    </div>
                </div>

                <!-- actions -->
                <div class="ul-header-actions">
                    <a href="{{ route('cart.index') }}"><i class="flaticon-grocery-store"></i></a>
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
