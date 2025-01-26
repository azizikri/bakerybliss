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
                                    <span class="ul-shop-details-price"> Rp.
                                        {{ number_format($product->price, 2, ',', '.') }}</span>
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
                                    <input type="number" name="quantity" id="ul-shop-details-quantity"
                                        class="ul-product-quantity" value="1" min="1" readonly />
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

                            <div class="ul-shop-details-actions">
                                <div class="left">
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline"
                                        id="addToCartForm">
                                        @csrf
                                        <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                        <button type="submit" class="add-to-cart">
                                            Add to Cart
                                            <span class="icon"><i class="flaticon-cart"></i></span>
                                        </button>
                                    </form>
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
@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('ul-shop-details-quantity');
            const hiddenInput = document.getElementById('hiddenQuantity');

            // Quantity controls
            document.querySelector('.quantityIncreaseButton').addEventListener('click', function() {
                quantityInput.value = parseInt(quantityInput.value);
                hiddenInput.value = quantityInput.value;
            });

            document.querySelector('.quantityDecreaseButton').addEventListener('click', function() {
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value);
                    hiddenInput.value = quantityInput.value;
                }
            });

            // AJAX form submission
            $('#addToCartForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response.message);
                        updateCartCount(response.cartCount);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            function updateCartCount(count) {
                $('.cart-count').text(count);
            }
        });
    </script>
@endpush
