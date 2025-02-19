<?php

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('transactions', TransactionController::class);

Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/cashier', function () {
        return view('cashier');
    });

    Route::get('/customer', function () {
        return view('customer');
    });

    Route::get('/transaction', function () {
        return view('transaction');
    });
    Route::get('transaction/{id}', function ($id) {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect('transaction')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('transaction', compact('transaction'));
    });

    Route::middleware('admin')->group(function () {
        Route::get('/product', function () {
            return view('product');
        });
        Route::get('product/{id}', function ($id) {
            $product = Product::find($id);

            if (!$product) {
                return redirect('product')->with('error', 'Product not found');
            }

            return view('product', compact('product'));
        });
    });
});

Route::get('/', function () {
    return view('landing');
});
