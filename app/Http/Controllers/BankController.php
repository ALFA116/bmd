<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            $wallet = new Wallet([
                'users_id' => $user->id,
                'credit' => 0,
                'debit' => 0,
                'status' => 'active',
            ]);
            $wallet->save();
        }

        $wallet->credit += $request->amount;
        $wallet->save();

        // Increase bank balance
        $bankWallet = Wallet::where('users_id', 1)->first(); // Assuming bank user ID is 1
        if ($bankWallet) {
            $bankWallet->credit += $request->amount;
            $bankWallet->save();
        }

        Transaction::create([
            'users_id' => $user->id,
            'status' => 'dibayar',
            'order_code' => uniqid(),
            'price' => $request->amount,
            'quantity' => 1,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Funds entered successfully.');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if ($wallet && $wallet->credit >= $request->amount) {
            $wallet->credit -= $request->amount;
            $wallet->save();

            // Decrease bank balance
            $bankWallet = Wallet::where('users_id', 1)->first();
            if ($bankWallet) {
                $bankWallet->credit -= $request->amount;
                $bankWallet->save();
            }

            Transaction::create([
                'users_id' => $user->id,
                'status' => 'diambil',
                'order_code' => uniqid(),
                'price' => $request->amount,
                'quantity' => 1,
                'description' => 'Withdrawal',
            ]);

            return redirect()->back()->with('success', 'Funds withdrawn successfully.');
        }

        return redirect()->back()->with('error', 'Insufficient balance.');
    }

    public function approveTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction->status == 'Menunggu') {
            $studentWallet = Wallet::where('users_id', $transaction->users_id)->first();
            $bankWallet = Wallet::where('users_id', 1)->first();

            if ($transaction->description != 'Withdrawal') {
                $studentWallet->credit += $transaction->price;
                $bankWallet->credit += $transaction->price;
            } else {
                $studentWallet->credit -= $transaction->price;
                $bankWallet->credit -= $transaction->price;
            }

            $transaction->status = 'approved';
            $transaction->save();
            $studentWallet->save();
            $bankWallet->save();
        }

        return back()->with('success', 'Transaction approved.');
    }

    public function rejectTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction->status != 'rejected') {
            $transaction->status = 'rejected';
            $transaction->save();
        }

        return back()->with('success', 'Transaction rejected.');
    }

    public function dashboard()
    {
        $transactions = Transaction::with('user')->get();
        return view('bank.dashboard', compact('transactions'));
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
            'status' => 'pending',
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
            'status' => 'pending',
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
            'status' => 'pending',
            'order_code' => uniqid(),
            'price' => $request->amount,
            'quantity' => 1,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Transfer initiated, awaiting approval.');
    }

    public function downloadTransactionHistory()
    {
        $transactions = Transaction::with('user')->get();

        $pdf = \PDF::loadView('pdf.transaction_history', compact('transactions'));
        return $pdf->download('transaction_history.pdf');
    }
}
