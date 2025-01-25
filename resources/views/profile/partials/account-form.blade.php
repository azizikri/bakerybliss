<div class="mt-6">
    <h3 class="text-lg font-medium text-gray-900">{{ __('Bank Accounts') }}</h3>
    <div class="space-y-4">
        @foreach ($user->accounts as $account)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div>
                    <p class="text-sm">{{ $account->name }}</p>
                    <p class="text-xs text-gray-500">{{ $account->bank->name }} -
                        {{ $account->account_number }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('accounts.edit', $account) }}"
                        class="text-sm text-orange-600 hover:text-orange-500">Edit</a>
                    <form method="POST" action="{{ route('accounts.destroy', $account) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-500"
                            onclick="return confirm('Delete account?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        <a href="{{ route('accounts.create') }}" class="inline-block text-sm text-orange-600 hover:text-orange-500">+
            Add New Account</a>
    </div>
    @if ($user->accounts->isEmpty())
        <div class="p-3 text-sm text-gray-500 rounded-lg bg-gray-50">
            {{ __('No bank accounts saved yet.') }}
        </div>
    @endif
</div>
