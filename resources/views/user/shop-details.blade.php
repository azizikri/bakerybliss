@extends('user.layouts.main')
@section('content')
    <main>
        <br>
        <br>
        <br>
        <section class="ul-shop-details ul-section-spacing">
            <div class="ul-container">
                <div class="row row-cols-md-2 row-cols-1 ul-bs-row align-items-start">
                    <!-- img -->
                    <div class="col">
                        <div class="ul-shop-details-img">
                            <img src="{{ $product->thumbnail }}" alt="Image" />
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col">
                        <div class="ul-shop-details-txt">
                            <div class="ul-shop-details-txt-header d-flex align-items-start justify-content-between">
                                <div class="left">
                                    <!-- product title -->
                                    <h3 class="ul-shop-details-title">{{ $product->name }}</h3>
                                </div>

                                <!-- price -->
                                <div class="right">
                                    <span class="ul-shop-details-price">{{ 'Rp.' . $product->price }}</span>
                                </div>
                            </div>

                            <!-- product description -->
                            @if (isset($product->description))
                                <p class="ul-shop-details-descr">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <!-- product quantity -->
                            <div class="ul-shop-details-option ul-shop-details-quantity">
                                <span class="title">Quantity</span>
                                <form action="#" class="ul-product-quantity-wrapper">
                                    <input type="number" name="product-quantity" id="ul-shop-details-quantity"
                                        class="ul-product-quantity" value="1" min="1" readonly="" />
                                    <div class="btns">
                                        <button type="button" class="quantityIncreaseButton">
                                            <i class="flaticon-plus"></i>
                                        </button>
                                        <button type="button" class="quantityDecreaseButton">
                                            <i class="flaticon-minus-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- product actions -->
                            <div class="ul-shop-details-actions">
                                <div class="left">
                                    <button class="add-to-cart">
                                        Add to Cart
                                        <span class="icon"><i class="flaticon-cart"></i></span>
                                    </button>
                                    <button class="add-to-wishlist">
                                        <span class="icon"><i class="flaticon-heart"></i></span>
                                        Add to wishlist
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  -->
    </main>
@endsection
