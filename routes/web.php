<?php

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);
Route::resource('transactions', TransactionController::class);

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('cashier', function () {
    return view('cashier');
});

Route::get('customer', function () {
    return view('customer');
});

Route::get('customer/{id}', function ($id) {
    $customer = Customer::find($id);

    if (!$customer) {
        return redirect('customer')->with('error', 'Pembeli tidak ditemukan.');
    }

    return view('customer', compact('customer'));
});

Route::get('product', function () {
    return view('product');
});

Route::get('product/{id}', function ($id) {
    $product = Product::find($id);

    if (!$product) {
        return redirect('product')->with('error', 'Product not found');
    }

    return view('product', compact('product'));
});

Route::get('transaction', function () {
    return view('transaction');
});

Route::get('transaction/{id}', function ($id) {
    $transaction = Transaction::find($id);

    if (!$transaction) {
        return redirect('transaction')->with('error', 'Transaksi tidak ditemukan.');
    }

    return view('transaction', compact('transaction'));
});
