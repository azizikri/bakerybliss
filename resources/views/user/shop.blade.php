@extends('user.layouts.main')
@section('content')
    <!-- FOODS SECTION START -->
    <main>
        <section class="ul-foods-shop ul-section-spacing">
            <div class="ul-shop-container">
                <div class="row ul-bs-row row-cols-lg-4 row-cols-md-3 row-cols-2 row-cols-xxs-1">
                    <!-- single menu item -->
                    @forelse ($products as $product)
                        <div class="col">
                            <a href="{{ route('catalog.show', $product->id) }}">
                                <div class="ul-food">
                                    <div class="ul-food-img">
                                        <img src="{{ $product->thumbnail }}" alt="food Image" />
                                    </div>
                                    <div class="ul-food-txt">
                                        <a href="shop-details.html" class="ul-food-title">{{ $product->name }}</a>
                                        <p class="ul-food-sub-title">
                                            {{ $product->description ?? '' }}
                                        </p>
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="ul-food-add-to-cart-btn">
                                                <i class="flaticon-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h1>No Product</h1>
                    @endforelse
                </div>

                <!-- PAGINATION START -->
                {!! $products->links() !!}
                <!-- PAGINATION END -->
            </div>
        </section>
    </main>
@endsection
