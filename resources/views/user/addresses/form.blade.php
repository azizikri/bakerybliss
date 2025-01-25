@props(['address' => null])

<form method="POST" action="{{ $address ? route('addresses.update', $address) : route('addresses.store') }}">
    @csrf
    @if ($address)
        @method('PATCH')
    @endif

    <div class="space-y-4">
        <div>
            <x-input-label for="address_name" :value="__('Address Name')" />
            <x-text-input id="address_name" name="address_name" class="block w-full mt-1" :value="old('address_name', $address->address_name ?? '')" required />
            <x-input-error :messages="$errors->get('address_name')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="person_name" :value="__('Person Name')" />
                <x-text-input id="person_name" name="person_name" class="block w-full mt-1" :value="old('person_name', $address->person_name ?? '')" required />
                <x-input-error :messages="$errors->get('person_name')" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Person Phone')" />
                <x-text-input id="phone" name="phone" class="block w-full mt-1" :value="old('phone', $address->phone ?? '')" required />
                <x-input-error :messages="$errors->get('phone')" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" class="block w-full mt-1" :value="old('city', $address->city ?? '')" required />
                <x-input-error :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="postal_code" :value="__('Postal_code')" />
                <x-text-input id="postal_code" name="postal_code" class="block w-full mt-1" :value="old('postal_code', $address->postal_code ?? '')"
                    required />
                <x-input-error :messages="$errors->get('postal_code')" />
            </div>
        </div>

        <div>
            <x-input-label for="address" :value="__('Address Name')" />
            <x-text-area id="address" name="address" class="block w-full mt-1" :value="old('address', $address->address ?? '')" required />
            <x-input-error :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" class="block w-full mt-1" :value="old('notes', $address->notes ?? '')" required />
            <x-input-error :messages="$errors->get('notes')" />
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <a href="{{ route('addresses.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
        </div>
    </div>
</form>
