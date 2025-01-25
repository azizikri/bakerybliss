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
                            <div class="vector-img">
                                <img src="assets/img/about-img-1.jpg" alt="Image" />
                            </div>
                            <img src="assets/img/about-img-2.jpg" alt="Image" />
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col-xl-7 col-lg-8 col-md-7 col">
                        <div class="ul-about-txt">
                            <span class="ul-section-sub-title ul-section-sub-title--2"><i class="flaticon-tray"></i>
                                About US
                                <i class="flaticon-tray"></i></span>
                            <h2 class="ul-section-title">
                                Variety of flavours from american cuisine
                            </h2>
                            <p class="ul-section-descr">
                                Every dish is not just prepared it's a crafted with a savor
                                the a utmost precision and a deep understanding sdf of flavor
                                harmony. The experienced hands of our chefs
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

                            <div class="ul-about-author">
                                <div class="left">
                                    <div class="ul-about-author-img">
                                        <img src="assets/img/author.png" alt="Author Image" />
                                    </div>
                                    <div class="author-txt">
                                        <span class="ul-about-author-title">Zbuild, CEO</span>
                                        <h3 class="ul-about-author-name">Amjad Hossen</h3>
                                    </div>
                                </div>

                                <div class="right">
                                    <img src="assets/img/signature.png" alt="signature" />
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
                        <li class="splide__slide">
                            <h2 class="ul-menus-title-txt">Special Burger</h2>
                        </li>
                        <li class="splide__slide">
                            <h2 class="ul-menus-title-txt">Chicken Pizza</h2>
                        </li>
                        <li class="splide__slide">
                            <h2 class="ul-menus-title-txt">GRILLED CHICKEN</h2>
                        </li>
                        <li class="splide__slide">
                            <h2 class="ul-menus-title-txt">CHCKEN NOODLES</h2>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- vector -->
            <div class="ul-about-vectors">
                <img src="assets/img/about-vector-1.png" alt="vector" class="vector-1 wow animate__fadeInLeft" />
                <img src="assets/img/about-vector-2.png" alt="vector" class="vector-2 wow animate__fadeInRight" />
            </div>
        </section>
        <!-- ABOUT SECTION END -->

        <!-- CTA SECTION START -->
        <section class="ul-inner-cta">
            <div class="ul-inner-cta-container wow animate__fadeInUp">
                <div class="row gx-4 align-items-center">
                    <div class="col-md-4">
                        <div class="ul-inner-cta-txt">
                            <span class="ul-section-sub-title">WELCOME FRESHEAT</span>
                            <h2 class="ul-section-title">Todays Special Food</h2>
                            <span class="ul-inner-cta-descr">Limited Time Offer</span>
                            <a href="menu-1.html" class="ul-btn">Order Now <i class="flaticon-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="ul-inner-cta-img">
                            <img src="assets/img/inner-cta-img.png" alt="Image" class="main-img" />
                            <img src="assets/img/inner-cta-discount-tag.png" alt="discount tag" class="discount-tag" />
                            <img src="assets/img/cta-inner-img-vector.svg" alt="vector" class="img-vector" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- vectors -->
            <div class="ul-inner-cta-vectors">
                <img src="assets/img/inner-cta-vector-1.png" alt="vector" class="vector-1" />
                <img src="assets/img/inner-cta-vector-2.png" alt="vector" class="vector-2" />
                <img src="assets/img/inner-cta-vector-3.png" alt="vector" class="vector-3" />
            </div>
        </section>
        <!-- CTA SECTION END -->

        <!-- CHEF SECTION START -->
        <section class="ul-chef ul-section-spacing">
            <div class="ul-container wow animate__fadeInUp">
                <!-- heading -->
                <div class="text-center ul-section-heading justify-content-center">
                    <div class="left">
                        <span class="ul-section-sub-title"><i class="flaticon-tray"></i> Our chef
                            <i class="flaticon-tray"></i></span>
                        <h2 class="ul-section-title">Meet Our Expert Chef</h2>
                    </div>
                </div>

                <!-- chef slider -->

                <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-chef-row">
                    <!-- single chef -->
                    <div class="col">
                        <div class="ul-chef-card">
                            <div class="ul-chef-card-img">
                                <img src="assets/img/chef-1.jpg" alt="chef Image" />
                            </div>

                            <div class="ul-chef-card-txt">
                                <h4 class="ul-chef-card-title">Ralph Edwards</h4>
                                <span class="ul-chef-card-subtitle">Sr. Chef</span>
                            </div>
                            <div class="ul-chef-card-social">
                                <div class="ul-chef-card-social-links">
                                    <a href="#" class=""><i class="flaticon-linkedin-big-logo"></i></a>
                                    <a href="#" class=""><i class="flaticon-instagram"></i></a>
                                    <a href="#" class=""><i class="flaticon-youtube"></i></a>
                                </div>
                                <span class="ul-chef-card-social-title">Share</span>
                            </div>
                        </div>
                    </div>

                    <!-- single chef -->
                    <div class="col">
                        <div class="ul-chef-card">
                            <div class="ul-chef-card-img">
                                <img src="assets/img/chef-2.jpg" alt="chef Image" />
                            </div>

                            <div class="ul-chef-card-txt">
                                <h4 class="ul-chef-card-title">Devon Lane</h4>
                                <span class="ul-chef-card-subtitle">Team Leader</span>
                            </div>
                            <div class="ul-chef-card-social">
                                <div class="ul-chef-card-social-links">
                                    <a href="#" class=""><i class="flaticon-linkedin-big-logo"></i></a>
                                    <a href="#" class=""><i class="flaticon-instagram"></i></a>
                                    <a href="#" class=""><i class="flaticon-youtube"></i></a>
                                </div>
                                <span class="ul-chef-card-social-title">Share</span>
                            </div>
                        </div>
                    </div>

                    <!-- single chef -->
                    <div class="col">
                        <div class="ul-chef-card">
                            <div class="ul-chef-card-img">
                                <img src="assets/img/chef-3.jpg" alt="chef Image" />
                            </div>

                            <div class="ul-chef-card-txt">
                                <h4 class="ul-chef-card-title">Marvin McKinney</h4>
                                <span class="ul-chef-card-subtitle">Nursing Assistant</span>
                            </div>
                            <div class="ul-chef-card-social">
                                <div class="ul-chef-card-social-links">
                                    <a href="#" class=""><i class="flaticon-linkedin-big-logo"></i></a>
                                    <a href="#" class=""><i class="flaticon-instagram"></i></a>
                                    <a href="#" class=""><i class="flaticon-youtube"></i></a>
                                </div>
                                <span class="ul-chef-card-social-title">Share</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- vectors -->
            <div class="ul-section-vectors ul-chef-vectors">
                <img src="assets/img/chef-vector-1.png" alt="vector" class="wow animate__fadeInLeft" />
            </div>
        </section>
        <!-- CHEF SECTION END -->

        <!-- TESTIMONIAL SECTION START -->
        <section class="overflow-hidden ul-testimonial ul-inner-testimonial ul-section-spacing">
            <div class="ul-inner-testimonial-container wow animate__fadeInUp">
                <div class="row align-items-center gy-4 justify-content-between">
                    <!-- testimonial slider -->
                    <div class="col-lg-7">
                        <div class="ul-testimonial-txt wow animate__fadeInUp">
                            <div class="ul-section-heading">
                                <div>
                                    <span class="ul-section-sub-title ul-section-sub-title--2"><i
                                            class="flaticon-tray"></i> Testimonials
                                        <i class="flaticon-tray"></i></span>
                                    <h2 class="ul-section-title">
                                        What have lots of happy customer feedback
                                    </h2>
                                </div>
                            </div>
                            <div class="ul-testimonial-slider swiper">
                                <div class="swiper-wrapper">
                                    <!-- single slide -->
                                    <div class="swiper-slide">
                                        <div class="ul-testimony">
                                            <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                            <p class="ul-testimony-txt">
                                                Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical
                                                Latin literature from 45 BC, making it over 2000 years
                                                old. Richard McClintock !
                                            </p>
                                        </div>
                                    </div>

                                    <!-- single slide -->
                                    <div class="swiper-slide">
                                        <div class="ul-testimony">
                                            <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                            <p class="ul-testimony-txt">
                                                Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical
                                                Latin literature from 45 BC, making it over 2000 years
                                                old. Richard McClintock !
                                            </p>
                                        </div>
                                    </div>

                                    <!-- single slide -->
                                    <div class="swiper-slide">
                                        <div class="ul-testimony">
                                            <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                            <p class="ul-testimony-txt">
                                                Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical
                                                Latin literature from 45 BC, making it over 2000 years
                                                old. Richard McClintock !
                                            </p>
                                        </div>
                                    </div>

                                    <!-- single slide -->
                                    <div class="swiper-slide">
                                        <div class="ul-testimony">
                                            <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                                            <p class="ul-testimony-txt">
                                                Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical
                                                Latin literature from 45 BC, making it over 2000 years
                                                old. Richard McClintock !
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="ul-testimonial-reviewer-slider swiper">
                                    <div class="swiper-wrapper">
                                        <!-- single reviewer slide -->
                                        <div class="swiper-slide">
                                            <div class="ul-testimonial-reviewer">
                                                <img src="assets/img/reviewer-1.png" alt="Reviewer Image"
                                                    class="reviewer-img" />
                                            </div>
                                        </div>

                                        <!-- single reviewer slide -->
                                        <div class="swiper-slide">
                                            <div class="ul-testimonial-reviewer">
                                                <img src="assets/img/reviewer-2.png" alt="Reviewer Image"
                                                    class="reviewer-img" />
                                            </div>
                                        </div>

                                        <!-- single reviewer slide -->
                                        <div class="swiper-slide">
                                            <div class="ul-testimonial-reviewer">
                                                <img src="assets/img/reviewer-3.png" alt="Reviewer Image"
                                                    class="reviewer-img" />
                                            </div>
                                        </div>

                                        <!-- single reviewer slide -->
                                        <div class="swiper-slide">
                                            <div class="ul-testimonial-reviewer">
                                                <img src="assets/img/reviewer-1.png" alt="Reviewer Image"
                                                    class="reviewer-img" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="stroke"></span>
                                <div class="ul-testimonial-slider-nav">
                                    <button class="prev">
                                        <i class="flaticon-left-arrow"></i>
                                    </button>
                                    <button class="next">
                                        <i class="flaticon-right-arrow-3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- img -->
                    <div class="col-lg-5">
                        <div class="ul-testimonial-img ul-inner-testimonial-img wow animate__fadeInUp">
                            <img src="assets/img/inner-testimonial-bg.png" alt="Testimonial Image" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- vectors -->
            <div class="ul-testimonial-vectors">
                <img src="assets/img/banner-vector-2.png" alt="vecto" class="vector-1 wow animate__fadeInLeft" />
                <img src="assets/img/about-vector-1.png" alt="vecto" class="vector-2 wow animate__fadeInLeft" />
            </div>
        </section>
        <!-- TESTIMONIAL SECTION END -->

        <!-- GALLERY SECTION START -->
        <div class="ul-gallery">
            <div class="row row-cols-lg-5 row-cols-md-4 row-cols-3 g-0">
                <!-- single gallery item -->
                <div class="col wow animate__fadeInUp">
                    <div class="ul-gallery-item">
                        <img src="assets/img/gallery-img-1.jpg" alt="Gallery image" />
                        <a href="assets/img/gallery-img-1.jpg" data-fslightbox="gallery"><i
                                class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="col wow animate__fadeInUp">
                    <div class="ul-gallery-item">
                        <img src="assets/img/gallery-img-2.jpg" alt="Gallery image" />
                        <a href="assets/img/gallery-img-2.jpg" data-fslightbox="gallery"><i
                                class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="col wow animate__fadeInUp">
                    <div class="ul-gallery-item">
                        <img src="assets/img/gallery-img-3.jpg" alt="Gallery image" />
                        <a href="assets/img/gallery-img-3.jpg" data-fslightbox="gallery"><i
                                class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="col wow animate__fadeInUp">
                    <div class="ul-gallery-item">
                        <img src="assets/img/gallery-img-4.jpg" alt="Gallery image" />
                        <a href="assets/img/gallery-img-4.jpg" data-fslightbox="gallery"><i
                                class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="col wow animate__fadeInUp">
                    <div class="ul-gallery-item">
                        <img src="assets/img/gallery-img-5.jpg" alt="Gallery image" />
                        <a href="assets/img/gallery-img-5.jpg" data-fslightbox="gallery"><i
                                class="flaticon-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- GALLERY SECTION END -->
    </main>
@endsection
