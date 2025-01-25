<div class="mt-6">
    <h3 class="text-lg font-medium text-gray-900">{{ __('Addresses') }}</h3>
    <div class="space-y-4">
        @foreach ($user->addresses as $address)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div>
                    <p class="text-sm">{{ $address->address_name }}, {{ $address->city }},
                        {{ $address->postal_code }}</p>
                    <p class="text-xs text-gray-500">{{ $address->address }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('addresses.edit', $address) }}"
                        class="text-sm text-orange-600 hover:text-orange-500">Edit</a>
                    <form method="POST" action="{{ route('addresses.destroy', $address) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-500">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        <a href="{{ route('addresses.create') }}" class="inline-block text-sm text-orange-600 hover:text-orange-500">+
            Add New Address</a>
    </div>
    @if ($user->addresses->isEmpty())
        <div class="p-3 text-sm text-gray-500 rounded-lg bg-gray-50">
            {{ __('No addresses saved yet.') }}
        </div>
    @endif
</div>
