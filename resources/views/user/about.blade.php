@extends('user.layouts.main')
@section('content')
    <!-- FOODS SECTION START -->
    <main>
        <br>
        <br>
        <br>
        <!-- ABOUT SECTION START -->
        <section class="ul-about ul-inner-about ul-section-spacing wow animate__fadeInUp">
            <div class="ul-container">
                <div class="row row-cols-xxl-2 row-cols-1 align-items-center gy-4">
                    <div class="col-xl-5 col-lg-4 col-md-5 col">
                        <div class="ul-about-imgs">
                            <img src="{{ asset('user/img/aboutus.jpg') }}" alt="Image" style="border-radius: 50%;" />
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col-xl-7 col-lg-8 col-md-7 col">
                        <div class="ul-about-txt">
                            <span class="ul-section-sub-title ul-section-sub-title--2"><i class="flaticon-tray"></i>
                                About US
                                <i class="flaticon-tray"></i></span>
                            <h2 class="ul-section-title">
                                Where Every Bite Brings Pure Bliss
                            </h2>
                            <p class="ul-section-descr">
                                At Bliss Bakery, we believe that every day deserves a moment of sweet joy.
                                Our master bakers pour their hearts into creating artisanal treats that
                                transform ordinary moments into extraordinary memories.
                            </p>

                            <div class="ul-about-list">
                                <div class="ul-about-list-item">
                                    <div class="icon"><i class="flaticon-quality"></i></div>
                                    <div class="txt">
                                        <h3 class="ul-about-list-item-title">
                                            Super Quality Food
                                        </h3>
                                        <p class="ul-about-list-item-descr">
                                            Served our Testy Food & good food by friendly
                                        </p>
                                    </div>
                                </div>

                                <div class="ul-about-list-item">
                                    <div class="icon"><i class="flaticon-chef"></i></div>
                                    <div class="txt">
                                        <h3 class="ul-about-list-item-title">Qualified Chef</h3>
                                        <p class="ul-about-list-item-descr">
                                            Served our Testy Food & good food by friendly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- section title slider -->
            <div class="pb-0 mb-0 ul-menus-title-slider splide ul-section-spacing">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($products as $product)
                            <li class="splide__slide">
                                <h2 class="ul-menus-title-txt">{{ $product->name }}</h2>
                            </li>
                        @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- ABOUT SECTION END -->
    </main>
@endsection
