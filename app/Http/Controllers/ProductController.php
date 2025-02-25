<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    # Store: Data Produk
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/images/products'), $imagename);
        }

        Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagename
        ]);

        return redirect(url('/product'))->with('success', 'Berhasil.');
    }

    # Update: Data Produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/images/products'), $imagename);
            $product->image = $imagename;
        }

        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $product->image
        ]);

        return redirect(url('/product'))->with('success', 'Berhasil.');
    }

    # Destroy: Data Produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(url('/product'))->with('success', 'Berhasil.');
    }
}
