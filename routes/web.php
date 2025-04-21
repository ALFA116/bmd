<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginproses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/bank/dashboard', [BankController::class, 'dashboard'])->name('bank.dashboard')->middleware('auth');
Route::get('/siswa/dashboard', [SiswaController::class, 'showDashboard'])->name('siswa.dashboard')->middleware('auth');

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/create-user', [AdminController::class, 'createUser']);
Route::post('admin/store-user', [AdminController::class, 'storeUser']);
Route::get('admin/edit-user/{id}', [AdminController::class, 'editUser']);
Route::post('admin/update-user/{id}', [AdminController::class, 'updateUser']);


Route::get('/siswa/dashboard', [SiswaController::class, 'showDashboard'])->name('siswa.dashboard');
Route::post('/siswa/enter-funds', [siswaController::class, 'enterFunds'])->name('siswa.enterFunds');
Route::post('/siswa/withdraw-funds', [siswaController::class, 'withdrawFunds'])->name('siswa.withdrawFunds');
Route::post('/siswa/transfer-funds', [siswaController::class, 'transferFunds'])->name('siswa.transferFunds');

Route::get('/bank/dashboard', [BankController::class, 'dashboard'])->name('bank.dashboard');
Route::post('/bank/deposit', [BankController::class, 'deposit'])->name('bank.deposit');
Route::post('/bank/withdraw', [BankController::class, 'withdraw'])->name('bank.withdraw');
Route::post('/bank/approve-transaction/{id}', [BankController::class, 'approveTransaction'])->name('bank.approveTransaction');
Route::post('/bank/reject-transaction/{id}', [BankController::class, 'rejectTransaction'])->name('bank.rejectTransaction');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/siswa/download-transaction-history', [SiswaController::class, 'downloadTransactionHistory'])->name('siswa.downloadTransactionHistory');
Route::get('/bank/download-transaction-history', [BankController::class, 'downloadTransactionHistory'])->name('bank.downloadTransactionHistory');
Route::get('/admin/download-transaction-history', [AdminController::class, 'downloadTransactionHistory'])->name('admin.downloadTransactionHistory');