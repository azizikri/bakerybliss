<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-700">
            {{ __('Transaction Details') }} #{{ $transaction->transaction_id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 bg-white border-b border-gray-200">
                    <!-- Payment Reupload Section -->
                    @if (in_array($transaction->status, ['to_be_confirmed', 'payment_verified', 'reupload_payment']))
                        <div class="p-4 rounded-lg bg-orange-50">
                            <form method="POST" action="{{ route('transactions.update', $transaction) }}"
                                enctype="multipart/form-data">
                                @csrf @method('PATCH')
                                <div class="flex items-end gap-4">
                                    <div class="flex-1">
                                        <x-input-label for="payment_proof" :value="__('Update Payment Proof')" />
                                        <x-text-input id="payment_proof" name="payment_proof" type="file"
                                            class="block w-full mt-1" required />
                                        <x-input-error :messages="$errors->get('payment_proof')" />
                                    </div>
                                    <x-primary-button>Upload New Proof</x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Products Details -->
                    <div>
                        <h3 class="text-lg font-medium">Products</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Product</th>
                                        <th class="px-4 py-2 text-left">Price</th>
                                        <th class="px-4 py-2 text-left">Quantity</th>
                                        <th class="px-4 py-2 text-left">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($transaction->products as $product)
                                        <tr>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center">
                                                    @if ($product->product->thumbnail)
                                                        <img src="{{ $product->product->thumbnail }}"
                                                            alt="{{ $product->product->name }}"
                                                            class="w-16 h-16 mr-4 rounded">
                                                    @endif
                                                    <span>{{ $product->product->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-2">
                                                Rp. {{ number_format($product->price_on_purchase, 2, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                                            <td class="px-4 py-2">
                                                Rp. {{ number_format($product->sub_total, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="font-semibold">
                                        <td colspan="3" class="px-4 py-2 text-right">Products Total</td>
                                        <td class="px-4 py-2">
                                            Rp. {{ number_format($transaction->subtotal, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- Shipping Information -->
                        <div>
                            <h3 class="text-lg font-medium">Shipping Information</h3>
                            <p class="mt-2 text-sm">
                                {{ $transaction->address->street }}<br>
                                {{ $transaction->address->city }}, {{ $transaction->address->state }}<br>
                                {{ $transaction->address->postal_code }}, {{ $transaction->address->country }}
                            </p>
                        </div>

                        <!-- Payment Details -->
                        <div>
                            <h3 class="text-lg font-medium">Payment Details</h3>
                            <dl class="mt-2 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt>Subtotal:</dt>
                                    <dd>Rp. {{ number_format($transaction->subtotal, 2, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt>Shipping:</dt>
                                    <dd>Rp. {{ number_format($transaction->shipping, 2, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between font-medium">
                                    <dt>Total:</dt>
                                    <dd>Rp. {{ number_format($transaction->total, 2, ',', '.') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Payment Proof Display -->
                    <div>
                        <h3 class="text-lg font-medium">Payment Proof</h3>
                        @if (pathinfo($transaction->payment_proof, PATHINFO_EXTENSION) === 'pdf')
                            <a href="{{ Storage::url($transaction->payment_proof) }}" target="_blank"
                                class="inline-block mt-2 text-orange-600 hover:text-orange-500">
                                View PDF Document
                            </a>
                        @else
                            <img src="{{ Storage::url($transaction->payment_proof) }}" alt="Payment proof"
                                class="mt-2 rounded-lg max-w-[400px]">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
