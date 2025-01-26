<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-700">
            {{ __('My Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-4">
                        @forelse($transactions as $transaction)
                            <div class="p-4 border rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium">#{{ $transaction->transaction_id }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $transaction->status }} • {{ $transaction->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="flex gap-4">
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                            class="text-orange-600 hover:text-orange-500">
                                            View Details
                                        </a>
                                        <a href="{{ route('transactions.invoice', $transaction) }}"
                                            class="text-gray-600 hover:text-gray-900">
                                            Download Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="p-4 text-gray-500">No transactions found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
