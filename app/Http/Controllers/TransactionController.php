<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Address;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $addresses = Auth::user()->addresses;
        $accounts = Auth::user()->accounts;
        $statusOptions = Transaction::STATUS;
        $deliveryMethods = Transaction::DELIVERY_METHODS;

        return view('transactions.create', compact('addresses', 'accounts', 'statusOptions', 'deliveryMethods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where('user_id', Auth::id()),
            ],
            'account_id' => [
                'required',
                Rule::exists('accounts', 'id')->where('user_id', Auth::id()),
            ],
            'payment_proof' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'status' => 'required|in:'.implode(',', array_keys(Transaction::STATUS)),
            'subtotal' => 'required|numeric',
            'shipping' => 'required|numeric',
            'total' => 'required|numeric',
            'notes' => 'nullable|string',
            'delivery_method' => 'required|in:'.implode(',', array_keys(Transaction::DELIVERY_METHODS)),
        ]);

        $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
        $validated['payment_proof'] = $filePath;
        $validated['transaction_id'] = Transaction::generateTransactionId();
        $validated['user_id'] = Auth::id();

        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction created.');
    }

    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $validated = $request->validate([
            'payment_proof' => 'sometimes|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            Storage::disk('public')->delete($transaction->payment_proof);
            $validated['payment_proof'] = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction updated.');
    }
}
