<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Customer Report
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::whereHas('transactions')->count();
        $topCustomers = Customer::withCount('transactions')
            ->orderByDesc('transactions_count')
            ->limit(5)
            ->get();

        // Sales Report
        $totalSales = Transaction::sum('totalPrice');
        $totalTransactions = Transaction::count();
        $highestTransactions = Transaction::orderByDesc('totalPrice')->limit(5)->get();

        // Product Report
        $bestSellingProducts = Product::withCount('transactionDetails')
            ->orderByDesc('transaction_details_count')
            ->limit(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 10)->get();

        // Passing data to view
        return view('report.index', compact(
            'totalCustomers', 'activeCustomers', 'topCustomers',
            'totalSales', 'totalTransactions', 'highestTransactions',
            'bestSellingProducts', 'lowStockProducts'
        ));
    }
}
