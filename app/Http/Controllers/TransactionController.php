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

    public function index()
    {
        $transactions = Auth::user()->transactions()->with(['address', 'account'])->get();
        return view('user.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(404);
        }

        $transaction->load(['products.product', 'address', 'account']);
        return view('user.transactions.show', compact('transaction'));
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
            'subtotal' => 'required|numeric',
            'shipping' => 'required|numeric',
            'total' => 'required|numeric',
            'notes' => 'nullable|string',
            'delivery_method' => 'required|in:'.implode(',', array_keys(Transaction::DELIVERY_METHODS)),
        ]);

        try {
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            $validated['payment_proof'] = $filePath;
            $validated['transaction_id'] = Transaction::generateTransactionId();
            $validated['user_id'] = Auth::id();

            $cartItems = session()->get('cart', []);

            $transaction = null;
            \DB::transaction(function () use ($validated, $cartItems, &$transaction) {
                $transaction = Transaction::create($validated);

                foreach ($cartItems as $productId => $item) {
                    $transaction->products()->create([
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price_on_purchase' => $item['price'],
                        'sub_total' => $item['subtotal']
                    ]);
                }
            });

            session()->forget('cart');

            return redirect()->route('transactions.index')
                ->with('success', 'Transaction created successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error processing transaction: '.$e->getMessage());
        }
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(404);
        }

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

    public function invoice(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(404);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('user.transactions.invoice', [
            'transaction' => $transaction->load(['user', 'address', 'account'])
        ]);

        return $pdf->download("invoice-{$transaction->transaction_id}.pdf");
    }
}
