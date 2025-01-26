<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Invoice #{{ $transaction->transaction_id }}</h1>
        <p>Date: {{ $transaction->created_at->format('d M Y') }}</p>
    </div>

    <div class="row">
        <div style="width: 50%; float: left;">
            <h3>Bill To:</h3>
            <p>{{ $transaction->user->name }}<br>
                {{ $transaction->address->street }}<br>
                {{ $transaction->address->city }}, {{ $transaction->address->state }}<br>
                {{ $transaction->address->postal_code }}</p>
        </div>

        <div style="width: 50%; float: left;">
            <h3>Payment Method:</h3>
            <p>{{ $transaction->account->bank->name }}<br>
                Account #: {{ $transaction->account->account_number }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Subtotal</td>
                <td>{{ number_format($transaction->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>{{ number_format($transaction->shipping, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>Total</td>
                <td>{{ number_format($transaction->total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: center;">
        <p>Thank you for your business!</p>
    </div>
</body>

</html>
