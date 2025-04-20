<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>
    <h2>Transaction History</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>Rp. {{ number_format($transaction->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>