@extends('user.layouts.main')
@section('content')
    <!-- BANNER SECTION START -->
    <section class="ul-banner">
        <!-- top -->
        <div class="top">
            <div class="row gy-4 row-cols-md-2 row-cols-1 align-items-center flex-column-reverse flex-md-row">
                <!-- banner text -->
                <div class="col">
                    <div class="ul-banner-txt">
                        <div class="ul-banner-txt-slider swiper">
                            <div class="swiper-wrapper">
                                <!-- single slide -->
                                <div class="swiper-slide">
                                    <div class="ul-banner-txt-slide">
                                        <div class="wow animate__fadeInUp">
                                            <h1 class="ul-banner-title">
                                                Where Every Bite Brings Pure Bliss
                                            </h1>
                                            <p class="ul-banner-descr">
                                                At Bliss Bakery, we believe that every day deserves a moment of sweet joy.
                                                Our master bakers pour their hearts into creating artisanal treats that
                                                transform ordinary moments into extraordinary memories.
                                            </p>
                                            <div class="ul-banner-btns">
                                                <a href="shop.html" class="ul-btn">order now <i
                                                        class="flaticon-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- img -->
                <div class="col">
                    <div class="ul-banner-img wow animate__fadeInRight">
                        <div class="ul-banner-img-slider swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ asset('user/img/home_image.jpg') }}" alt="Banner Image"
                                        style="border-radius: 50%;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SECTION END -->

    <!-- FOODS SECTION START -->
    <section class="ul-foods ul-section-spacing">
        <!-- heading -->
        <div class="ul-container">
            <div class="text-center ul-section-heading justify-content-center">
                <div>
                    <span class="ul-section-sub-title">
                        <i class="flaticon-tray"></i>
                        <span class="txt">Best Product</span>
                        <i class="flaticon-tray"></i>
                    </span>
                    <h2 class="ul-section-title">Popular Product Items</h2>
                </div>
            </div>
        </div>

        <!-- foods slider -->
        <div class="ul-foods-container wow animate__fadeInUp">
            <div class="ul-foods-slider swiper">
                <div class="swiper-wrapper">
                    @forelse ($popularProducts as $product)
                        <!-- single item -->
                        <div class="swiper-slide">
                            <div class="ul-food">
                                <div class="ul-food-img">
                                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }} Image" />
                                </div>
                                <div class="ul-food-txt">
                                    <a href="shop-details.html" class="ul-food-title">{{ $product->name }}</a>
                                    <p class="ul-food-sub-title">
                                        {{ $product->description }}
                                    </p>
                                    <div class="ul-food-bottom">
                                        <h4 style="text-align: center;"><span class="number"> Rp.
                                                {{ number_format($product->price, 2, ',', '.') }}</span>
                                        </h4>
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="ul-food-add-to-cart-btn">
                                            <i class="flaticon-cart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="ul-foods-slider-pagination d-none"></div>
            </div>
        </div>
    </section>
    <!-- FOODS SECTION END -->

    <!-- MENU SECTION START -->
    <section class="ul-menus ul-section-spacing">
        <!-- sub title -->
        <div class="ul-container">
            <div class="text-center ul-section-heading justify-content-center">
                <div>
                    <span class="ul-section-sub-title"><i class="flaticon-tray"></i> our special menu
                        <i class="flaticon-tray"></i></span>
                </div>
            </div>
        </div>

        <!-- section title slider -->
        <div class="ul-menus-title-slider splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($popularProducts as $product)
                        <li class="splide__slide">
                            <h2 class="ul-menus-title-txt">{{ $product->name }}</h2>
                        </li>
                    @empty
                        <li>
                            <h2 class="ul-menus-title-txt">No Products</h2>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- menu -->
        <div class="ul-menus-tabs-wrapper">
            <div>
                <div class="ul-menus-tab-navs">
                    @forelse ($usedTags as $tag)
                        <button data-tab="{{ $tag->name }}-tab" class="tab-nav">
                            <span class="txt">{{ $tag->name }}</span>
                        </button>
                    @empty
                        @forelse ($tags as $tag)
                            <button data-tab="{{ $tag->name }}-tab" class="tab-nav">
                                <span class="txt">{{ $tag->name }}</span>
                            </button>
                        @empty
                            <span class="txt">Tags does not exists</span>
                        @endforelse
                    @endforelse
                </div>

                <div class="tabs">
                    <div class="ul-tab ul-menu-tab active" id="fast-food-tab">
                        <div class="row ul-bs-row row-cols-md-2 row-cols-1">
                            @forelse ($firstTagProducts as $product)
                                <!-- single menu item -->
                                <div class="col">
                                    <div class="ul-menu-item">
                                        <div class="ul-menu-item-img">
                                            <img src="{{ $product->thumbnail }}" alt="Menu Item Image" />
                                        </div>
                                        <div class="ul-menu-item-txt">
                                            <div class="left">
                                                <a href="{{ route('catalog.show', $product->id) }}"
                                                    class="ul-menu-item-title">{{ $product->name }}</a>
                                                <span class="ul-menu-item-sub-title">{{ $product->description }}</span>
                                                <!-- <span class="stroke"></span> -->
                                            </div>
                                            <span class="ul-menu-item-price"> Rp.
                                                {{ number_format($product->price, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h1>No Products</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- end menu -->
    </section>
    <div class="">
        <br>
        <br>
        <br>
        <br>
    </div>
@endsection
