<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }

        .balance {
            margin: 20px 0;
            font-size: 20px;
            color: green;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 47%;
        }

        .box h2 {
            margin-top: 0;
        }

        .box button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .box .save {
            background-color: #007bff;
            color: white;
        }

        .box .save:hover {
            background-color: #0056b3;
        }

        .box .withdraw {
            background-color: red;
            color: white;
        }

        .box .withdraw:hover {
            background-color: darkred;
        }

        .transaction-history {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .transaction-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .transaction-history th,
        .transaction-history td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .transaction-history button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 5px;
        }

        .transaction-history button.approve {
            background-color: #28a745;
            color: white;
        }

        .transaction-history button.approve:hover {
            background-color: #218838;
        }

        .transaction-history button.reject {
            background-color: #dc3545;
            color: white;
        }

        .transaction-history button.reject:hover {
            background-color: #c82333;
        }

        .transaction-history i {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="header">Dashboard siswa
        <div class="user-info">
            <i class="fa fa-user-circle" style="color: rgb(111, 197, 117);"></i>
            @if (auth()->check())
                <span>{{ auth()->user()->name }} | {{ auth()->user()->role->name }}</span>
            @else
                <span>Guest | Siswa</span>
            @endif
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="button" style="background-color:aqua; color: black;">Logout</button>
            </form>
        </div>
    </div>
    <div class="balance">
        Saldo Tersisa: Rp.{{ number_format(optional(auth()->user()->wallet)->credit ?? 0, 2) }}
    </div>
    <div class="container">
        <div class="box">
            <h2>Masukkan Dana</h2>
            <form method="POST" action="{{ route('siswa.enterFunds') }}">
                @csrf
                <label>Rp. <input type="number" name="amount" placeholder="Jumlah Dana"
                        style="width: 92%; padding: 10px; margin-bottom: 10px;" required></label>
                <input type="text" name="description" placeholder="Deskripsi"
                    style="width: 96%; padding: 10px; margin-bottom: 10px;" required>
                <button type="submit" class="save">Deposit</button>
            </form>
        </div>
        <div class="box">
            <h2>Ambil Uang</h2>
            <form method="POST" action="{{ route('siswa.withdrawFunds') }}">
                @csrf
                <label>Rp. <input type="number" name="amount" placeholder="Jumlah Dana" style="width: 92%; padding: 10px; margin-bottom: 10px;" required></label>
                <button type="submit" class="withdraw">Withdraw</button>
            </form>
        </div>
        <div class="box">
            <h2>Transfer Dana</h2>
            <form method="POST" action="{{ route('siswa.transferFunds') }}">
                @csrf
                <select name="recipient_id" required>
                    <option value="">-- Pilih Teman --</option>
                    @foreach($friends as $friend)
                        <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="amount" placeholder="Jumlah Dana" required>
                <input type="text" name="description" placeholder="Deskripsi" required>
                <button type="submit" class="save">Transfer</button>
            </form>
        </div>
    </div>

    <div class="transaction-history">
        <h2>Riwayat Transaksi</h2>
        <table>
            <tr>
                <th style="background-color: rgb(213, 205, 205);">Tanggal</th>
                <th style="background-color: rgb(213, 205, 205);">Deskripsi</th>
                <th style="background-color: rgb(3, 164, 239);">Status</th>
                <th style="background-color: rgb(26, 255, 80);">Jumlah</th>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>
                        {{ ucfirst($transaction->status) }}
                        @if($transaction->status == 'Menunggu')
                            <i class="fa fa-minus-circle" style="color: orange;"></i>
                        @elseif($transaction->status == 'approved')
                            <i class="fa fa-check-circle" style="color: green;"></i>
                        @elseif($transaction->status == 'rejected')
                            <i class="fa fa-times-circle" style="color: red;"></i>
                        @endif
                    </td>
                    <td>Rp. {{ number_format($transaction->price, 2) }}</td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('siswa.downloadTransactionHistory') }}" class="button" style="background-color: #007bff; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">Download PDF</a>
    </div>
</body>
</html>
