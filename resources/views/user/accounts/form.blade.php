@props(['account' => null, 'banks' => []])

<form method="POST" action="{{ $account ? route('accounts.update', $account) : route('accounts.store') }}">
    @csrf
    @if ($account)
        @method('PATCH')
    @endif

    <div class="space-y-4">
        <div>
            <x-input-label for="name" :value="__('Account Name')" />
            <x-text-input id="name" name="name" class="block w-full mt-1" :value="old('name', $account->name ?? '')" required />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="bank_id" :value="__('Bank')" />
            <select id="bank_id" name="bank_id"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                required>
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}"
                        {{ old('bank_id', $account->bank_id ?? '') == $bank->id ? 'selected' : '' }}>
                        {{ $bank->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('bank_id')" />
        </div>

        <div>
            <x-input-label for="account_number" :value="__('Account Number')" />
            <x-text-input id="account_number" name="account_number" class="block w-full mt-1" :value="old('account_number', $account->account_number ?? '')"
                required />
            <x-input-error :messages="$errors->get('account_number')" />
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <a href="{{ route('accounts.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
        </div>
    </div>
</form>
