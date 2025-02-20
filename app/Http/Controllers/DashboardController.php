<?php

namespace App\Http\Controllers;  

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('totalPrice');
        $totalProducts = Product::count();

        return view('dashboard', compact('totalCustomers', 'totalTransactions', 'totalRevenue', 'totalProducts'));
    }
}

