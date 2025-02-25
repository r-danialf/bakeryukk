<?php

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DatabaseDumpController;

Route::post('/database-dump', [DatabaseDumpController::class, 'dump'])
     ->middleware('auth')
     ->name('database.dump');


Route::get('/report', function () {
    return view('dashboard');
});

Route::get('/report/customers', [ReportController::class, 'printCustomers']);
Route::get('/report/products', [ReportController::class, 'printProducts']);
Route::get('/report/transactions', [ReportController::class, 'printTransactions']);
Route::get('/report/transactions/date', [ReportController::class, 'printTransactionsByDate']);


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

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/cashier', function () {
        return view('dashboard');
    });

    Route::get('/customer', function () {
        return view('dashboard');
    });
    Route::get('customer/{id}', function ($id) {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect('dashboard')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('dashboard', compact('customer'));
    });

    Route::get('/transaction', function () {
        return view('dashboard');
    });
    Route::get('transaction/{id}', function ($id) {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect('dashboard')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('dashboard', compact('transaction'));
    });

    Route::middleware('admin')->group(function () {
        Route::get('/product', function () {
            return view('dashboard');
        });
        Route::get('product/{id}', function ($id) {
            $product = Product::find($id);

            if (!$product) {
                return redirect('dashboard')->with('error', 'Product not found');
            }

            return view('dashboard', compact('product'));
        });
    });
});

Route::get('/', function () {
    return view('landing');
});
