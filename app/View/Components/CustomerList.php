<?php

namespace App\View\Components;

use Closure;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerList extends Component
{
    public $customers;

    public function __construct()
    {
        $this->customers = Customer::all();
    }

    public function render(): View|Closure|string
    {
        return view('components.customer-list', [
            'customers' => $this->customers
        ]);
    }

    public function showCustomer()
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Pembeli tidak ditemukan.'], 404);
        }

        return view('customer.show', compact('customer'));
    }
}
