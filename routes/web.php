<?php

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);

Route::get('/', function () {
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
        return redirect('/')->with('error', 'Pembeli tidak ditemukan.');
    }

    return view('customer', compact('customer'));
});

Route::get('product', function () {
    return view('product');
});

Route::get('product/{id}', function ($id) {
    $product = Product::find($id);

    if (!$product) {
        return redirect('/')->with('error', 'Product not found');
    }

    return view('product', compact('product'));
});

Route::get('transaction', function () {
    return view('transaction');
});
