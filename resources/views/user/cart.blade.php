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

            <div>
                <div class="ul-cart-actions">
                    <a href="{{ route('cart.index') }}"><button class="ul-cart-update-cart-btn">Update Cart</button></a>
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

                        {{-- Replace existing checkout button --}}
                        <button class="ul-cart-checkout-direct-btn" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                            CHECKOUT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Add this before the closing </main> tag -->
    <div class="modal fade" id="checkoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="py-4 text-center">
                    <img src="{{ asset('user/img/bca.png') }}" alt="Bank Logo" class="mb-4" style="max-width: 150px;">
                    <h3 class="mb-3">Account Number: 5657011148</h3>
                    <h3 class="mb-3">A.N: FACHRAD ZAUHAR AWWAL</h3>
                </div>
                <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Checkout Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Error Summary -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="subtotal" value="{{ old('subtotal', $subtotal) }}">
                        <input type="hidden" name="shipping" value="{{ old('shipping', $delivery) }}">
                        <input type="hidden" name="total" value="{{ old('total', $total) }}">

                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <select name="address_id" class="form-select @error('address_id') is-invalid @enderror"
                                required>
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}"
                                        {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                        {{ $address->address }}, {{ $address->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('address_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Account</label>
                            <select name="account_id" class="form-select @error('account_id') is-invalid @enderror"
                                required>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                        {{ $account->bank->name }} - {{ $account->account_number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('account_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery Method</label>
                            <select name="delivery_method"
                                class="form-select @error('delivery_method') is-invalid @enderror" required>
                                @foreach ($methods as $key => $method)
                                    <option value="{{ $key }}"
                                        {{ old('delivery_method') == $key ? 'selected' : '' }}>
                                        {{ $method }}
                                    </option>
                                @endforeach
                            </select>
                            @error('delivery_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Proof</label>
                            <input type="file" name="payment_proof"
                                class="form-control @error('payment_proof') is-invalid @enderror" accept="image/*,.pdf"
                                required>
                            @error('payment_proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn ul-btn">Complete Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                new bootstrap.Modal(document.getElementById('checkoutModal')).show();
            @endif
        });
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
