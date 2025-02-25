<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/products'), $imageName);
        }

        Product::create([
            'productName' => $request->productName,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect(url('/product'))->with('success', 'Produk berhasil dibuat.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->update([
            'productName' => $request->productName,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $product->image,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diubah.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(url('/product'))->with('success', 'Produk berhasil dihapus.');
    }
}
