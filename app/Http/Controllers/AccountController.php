<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $banks = Bank::all();
        return view('user.accounts.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bank_id' => 'required|exists:banks,id',
            'account_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('accounts')->where('user_id', Auth::id()),
            ],
        ]);

        Auth::user()->accounts()->create($validated);
        return redirect()->route('profile.edit')->with('success', 'Account created.');
    }

    public function edit(Account $account)
    {
        $banks = Bank::all();
        return view('user.accounts.edit', compact('account', 'banks'));
    }

    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bank_id' => 'required|exists:banks,id',
            'account_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('accounts')->ignore($account->id)->where('user_id', Auth::id()),
            ],
        ]);

        $account->update($validated);
        return redirect()->route('profile.edit')->with('success', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('profile.edit')->with('success', 'Account deleted.');
    }
}
