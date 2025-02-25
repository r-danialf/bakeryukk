<?php

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailsController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::get('/', function () { return view('welcome'); });

# Page: Pendaftaran
Route::get('/login',    function () { return view('login');    })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');

# Action: Pendaftaran
Route::post('/login',    [AuthController::class, 'login']    );
Route::post('/register', [AuthController::class, 'register'] );
Route::post('/logout',   [AuthController::class, 'logout']   )->name('logout');

# Action Resource: Menu-Menu Utama
Route::resource('customer',    CustomerController::class   )->only(['store', 'update', 'destroy']);
Route::resource('product',     ProductController::class    )->only(['store', 'update', 'destroy']);
Route::resource('transaction', TransactionController::class)->only(['store', 'update', 'destroy']);

# Middleware: User yang Terautentikasi
Route::middleware('auth')->group(function () {

    # Page: Tampilan Depan
    Route::get('/dashboard', [PageController::class, 'dashboard']   )->name('dashboard');
    Route::get('/cashier',   function () { return view('cashier'); })->name('cashier');

    # Page: Pelanggan
    Route::get('/customer',     function () { return view('customer'); })->name('customer');
    Route::get('customer/{id}', function ($id) {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect('customer')->with('error', 'Pelanggan tidak ditemukan.');
        }   return view('customer', compact('customer'));
    });

    # Page: Transaksi
    Route::get('/transaction',     function () { return view('transaction');})->name('transaction');
    Route::get('transaction/{id}', function ($id) {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect('transaction')->with('error', 'Transaksi tidak ditemukan.');
        }   return view('transaction', compact('transaction'));
    });

    # Middleware: Admin
    Route::middleware('admin')->group(function () {

        # Page: Produk
        Route::get('/product',      function () { return view('product'); });
        Route::get('product/{id}',  function ($id) {
            $product = Product::find($id);

            if (!$product) {
                return redirect('product')->with('error', 'Produk tidak ditemukan.');
            }   return view('product', compact('product'));
        });

    });
});
