<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    # Store: Data Pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'required|string',
            'telephone' => 'required|string|max:20'
        ]);

        Customer::create([
            'name'      => $request->name,
            'address'   => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect(url('/customer'))->with('success', 'Berhasil.');
    }

    # Update: Data Pelanggan
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'required|string',
            'telephone' => 'required|string|max:20'
        ]);

        $customer->update([
            'name'      => $request->name,
            'address'   => $request->address,
            'telephone' => $request->telephone
        ]);

        return redirect()->back()->with('success', 'Berhasil.');
    }

    # Destroy: Data Pelanggan
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect(url('/customer'))->with('success', 'Berhasil.');
    }
}
