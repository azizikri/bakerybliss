@extends('user.layouts.main')
@section('content')
    <!-- CART SECTION START -->
    <main>
        <br>
        <br>
        <br>
        <div class="ul-container ul-section-spacing">
            <div class="cart-top">
                <div class="table-responsive">
                    <table class="ul-cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cart as $cid => $c)
                                <tr data-product-id="{{ $cid }}">
                                    <td>
                                        <div class="ul-cart-product">
                                            <a href="{{ route('catalog.show', $cid) }}" class="ul-cart-product-img"><img
                                                    src="{{ $c['thumbnail'] }}" alt="Product" /></a>
                                            <a href="{{ route('catalog.show', $cid) }}"
                                                class="ul-cart-product-title">{{ $c['name'] }}</a>
                                        </div>
                                    </td>
                                    <td><span class="ul-cart-item-price">Rp.
                                            {{ number_format($c['price'], 0, ',', '.') }}</span></td>
                                    <td>
                                        <div class="mt-0 ul-shop-details-quantity">
                                            <form action="#" class="ul-product-quantity-wrapper">
                                                <input type="number" name="product-quantity" class="ul-product-quantity"
                                                    value="{{ $c['quantity'] }}" min="1" readonly="" />
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
                                    </td>
                                    <td><span class="ul-cart-item-subtotal">Rp.
                                            {{ number_format($c['subtotal'], 0, ',', '.') }}</span></td>
                                    <td>
                                        <div class="ul-cart-item-remove">
                                            <button><i class="flaticon-close"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cart-bottom">
                <div class="ul-cart-expense-overview">
                    <h3 class="ul-cart-expense-overview-title">Subtotal</h3>
                    <div class="middle">
                        <div class="single-row">
                            <span class="inner-title">Subtotal</span>
                            <span class="number">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="single-row">
                            <span class="inner-title">Shipping Fee</span>
                            <span class="number">Rp. {{ number_format($delivery, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="single-row">
                            <span class="inner-title">Total</span>
                            <span class="number">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <button class="ul-cart-checkout-direct-btn">CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('custom-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Add this to your JS file or in a script tag
        $(document).ready(function() {
            // Update quantity
            $('.quantityIncreaseButton, .quantityDecreaseButton').click(function() {
                console.log('Button clicked');
                let $input = $(this).closest('.ul-product-quantity-wrapper').find('.ul-product-quantity');
                let productId = $(this).closest('tr').data('product-id');
                let currentValue = parseInt($input.val());

                if ($(this).hasClass('quantityIncreaseButton')) {
                    currentValue;
                } else if (currentValue > 1) {
                    currentValue--;
                }

                $input.val(currentValue);
                console.log('New quantity:', currentValue);

                updateCartQuantity(productId, currentValue);
            });


            $('.ul-cart-item-remove button').click(function() {
                let productId = $(this).closest('tr').data('product-id');
                removeFromCart(productId);
            });

            function updateCartQuantity(productId, quantity) {
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        toastr.success(response.success);
                    },
                    error: function(error) {
                        toastr.error('Error updating cart');
                    }
                });
            }

            function removeFromCart(productId) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId
                    },
                    success: function(response) {
                        $(`tr[data-product-id="${productId}"]`).remove();
                        updateCartTotals();
                        toastr.success(response.success);
                    },
                    error: function(error) {
                        toastr.error('Error removing item');
                    }
                });
            }

        });
    </script>
@endpush
