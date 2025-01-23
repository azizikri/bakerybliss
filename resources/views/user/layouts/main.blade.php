<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} - @yield('title', 'Home')</title>

    <!-- libraries CSS -->
    <link rel="stylesheet" href="{{ asset('user/icon/flaticon_restics.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/splide/splide.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/swiper/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/slim-select/slimselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/animate-wow/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/vendor/flatpickr/flatpickr.min.css') }}" />


    <!-- custom CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}" />
    @stack('custom-styles')
</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- SIDEBAR SECTION START -->
    @include('user.layouts.sidebar')
    <!-- SIDEBAR SECTION END -->

    <!-- SEARCH MODAL SECTION START -->
    @include('user.layouts.modal')
    <!-- SEARCH MODAL SECTION END -->

    <!-- HEADER SECTION START -->
    @include('user.layouts.header')
    <!-- HEADER SECTION END -->

    <main>
        @yield('content')
    </main>


    <!-- FOOTER SECTION START -->
    @include('user.layouts.footer')
    <!-- FOOTER SECTION END -->

    <!-- libraries JS -->
    <script src="{{ asset('user/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('user/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('user/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('user/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('user/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('user/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('user/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('user/vendor/fslightbox/fslightbox.js') }}"></script>

    <!-- custom JS -->
    <script src="{{ asset('user/js/main.js') }}"></script>
    @stack('custom-scripts')
</body>

</html>
