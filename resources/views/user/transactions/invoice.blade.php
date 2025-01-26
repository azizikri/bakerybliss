<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice #{{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info {
            float: right;
            text-align: right;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .row {
            clear: both;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .col {
            width: 50%;
            float: left;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .total-section {
            float: right;
            width: 300px;
            margin-top: 20px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            background-color: #e9ecef;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-info">
            <h2>BLISS BAKERY</h2>
        </div>
        <h1>INVOICE</h1>
        <div class="invoice-details">
            <p><strong>Invoice #:</strong> {{ $transaction->transaction_id }}</p>
            <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> <span class="status-badge">{{ $transaction->status }}</span></p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Bill To:</h3>
            <p>
                {{ $transaction->user->name }}<br>
                {{ $transaction->address->address }}<br>
                {{ $transaction->address->city }}<br>
                {{ $transaction->address->postal_code }}
            </p>
        </div>
        <div class="col">
            <h3>Payment Details:</h3>
            <p>
                <strong>Bank:</strong> {{ $transaction->account->bank->name }}<br>
                <strong>Account #:</strong> {{ $transaction->account->account_number }}<br>
                <strong>Delivery Method:</strong> {{ $transaction->delivery_method }}
            </p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->products as $product)
                <tr>
                    <td>{{ $product->product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price_on_purchase, 2) }}</td>
                    <td>{{ number_format($product->sub_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table class="table">
            <tr>
                <td>Subtotal:</td>
                <td>{{ number_format($transaction->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>Shipping:</td>
                <td>{{ number_format($transaction->shipping, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>Total:</td>
                <td>{{ number_format($transaction->total, 2) }}</td>
            </tr>
        </table>
    </div>

    @if ($transaction->notes)
        <div class="row" style="margin-top: 150px;">
            <h4>Notes:</h4>
            <p>{{ $transaction->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>If you have any questions about this invoice, please contact us</p>
    </div>
</body>

</html>
