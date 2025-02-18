<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:16'
        ]);

        Customer::create([
            'customerName' => $request->customerName,
            'address' => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect(url('/customer'))->with('success', 'Pelanggan berhasil dibuat.');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customerName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:16'
        ]);

        $customer->update([
            'customerName' => $request->customerName,
            'address' => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect()->back()->with('success', 'Pelanggan berhasil diubah.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect(url('/customer'))->with('success', 'Pelanggan berhasil dihapus.');
    }
}
