<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions()
    {
        $transactions = Transaction::with(['customer', 'transactionDetails.product'])->get();
        return view('report.transactions', compact('transactions'));
    }
    public function printCustomers()
    {
        $customers = Customer::all();

        return view('reports.customers', compact('customers'));
    }

    public function printProducts()
    {
        $products = Product::all();

        return view('reports.products', compact('products'));
    }

    public function printTransactions()
    {
        $transactions = Transaction::with('transactionDetails')->get();

        return view('reports.transactions', compact('transactions'));
    }

    public function printTransactionsByDate(Request $request)
    {
        $date = $request->query('date');
        $transactions = Transaction::where('transactionDate', $date)->with('transactionDetails')->get();

        return view('reports.transactions', compact('transactions'));
    }
}
