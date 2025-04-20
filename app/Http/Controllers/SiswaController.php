<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    public function showDashboard()
    {
        $user = auth()->user();
        $transactions = $user->transactions;
        $friends = User::whereHas('role', function ($query) {
            $query->where('name', 'siswa');
        })->where('id', '!=', $user->id)->get();

        return view('siswa.dashboard', compact('user', 'transactions', 'friends'));
    }

    public function enterFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Transaction::create([
            'users_id' => $user->id,
            'status' => 'Menunggu',
            'order_code' => uniqid(),
            'price' => $request->amount,
            'quantity' => 1,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Funds entry initiated, awaiting approval.');
    }

    public function withdrawFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();

        Transaction::create([
            'users_id' => $user->id,
            'status' => 'Menunggu',
            'order_code' => uniqid(),
            'price' => $request->amount,
            'quantity' => 1,
            'description' => 'Withdrawal',
        ]);

        return redirect()->back()->with('success', 'Withdrawal initiated, awaiting approval.');
    }

    public function transferFunds(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Transaction::create([
            'users_id' => $user->id,
            'status' => 'Menunggu',
            'order_code' => uniqid(),
            'price' => $request->amount,
            'quantity' => 1,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Transfer initiated, awaiting approval.');
    }

    public function downloadTransactionHistory()
    {
        $user = auth()->user();
        $transactions = $user->transactions;

        $pdf = \PDF::loadView('pdf.transaction_history', compact('transactions'));
        return $pdf->download('transaction_history.pdf');
    }
}
