<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::with('role')->get();
        $totalTransactions = Transaction::count();

        return view('admin.dashboard', compact('users', 'totalTransactions'));
    }

    public function createUser()
    {
        return view('admin.create_user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $role = Role::where('name', $request->role)->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'roles_id' => $role->id,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        $role = Role::where('name', $request->role)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'roles_id' => $role->id,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function downloadTransactionHistory()
    {
        $transactions = Transaction::with('user')->get();

        $pdf = \PDF::loadView('pdf.transaction_history', compact('transactions'));
        return $pdf->download('transaction_history.pdf');
    }
}
