<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <div class="max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-start justify-between">
                <div class="text-gray-700">
                    <h2 class="mb-2 text-xl font-bold">Details</h2>
                    <p class="text-sm">{{ $transaction->user->name }}</p>
                    <p class="text-sm">{{ $transaction->address->phone }}</p>
                </div>
                <div class="text-2xl font-bold text-blue-600">
                    BAKERYBLISS
                </div>
            </div>
        </div>

        <!-- Order Info -->
        <div class="p-6 bg-gray-50">
            <div class="text-sm text-gray-600">
                <p>No. Pesanan: <span class="font-medium">{{ $transaction->transaction_id }}</span></p>
                <p>Tanggal: <span class="font-medium">{{ $transaction->created_at->format('Y-m-d') }}</span></p>
                <p>Jam: <span class="font-medium">{{ $transaction->created_at->format('H:i:s') }}</span></p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-3 text-sm font-semibold text-left text-gray-600">Description</th>
                        <th class="px-4 py-3 text-sm font-semibold text-left text-gray-600">Quantity</th>
                        <th class="px-4 py-3 text-sm font-semibold text-left text-gray-600">Currency</th>
                        <th class="px-4 py-3 text-sm font-semibold text-right text-gray-600">Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->products as $item)
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">Rp</td>
                            <td class="px-4 py-3 text-sm text-right text-gray-700">
                                Rp {{ number_format($item->sub_total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="p-6 bg-gray-50">
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal:</span>
                    <span class="font-medium">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Shipping Fee:</span>
                    <span class="font-medium">Rp {{ number_format($transaction->shipping, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold">
                    <span class="text-gray-600">Total:</span>
                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Bank Info -->
        <div class="p-6 border-t border-gray-200">
            <div class="text-sm text-gray-600">
                <p class="mb-1">Bank Name: <span class="font-medium">{{ $transaction->account->bank->name }}</span>
                </p>
                <p class="mb-1">Account Holder: <span
                        class="font-medium">{{ $transaction->account->user->name }}</span>
                </p>
                <p>IBAN/Account Number: <span class="font-medium">{{ $transaction->account->account_number }}</span>
                </p>
            </div>
        </div>

        <!-- Thank You Message -->
        <div class="p-6 text-center bg-gray-50">
            <p class="text-sm font-medium text-gray-600">Terima kasih atas pembelian anda</p>
        </div>
    </div>

    <style>
        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .max-w-3xl {
                max-width: none;
            }

            .shadow-lg {
                box-shadow: none;
            }

            .rounded-lg {
                border-radius: 0;
            }
        }
    </style>
</body>

</html>
