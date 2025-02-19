<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CashierProductList extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Product::all();
    }

    public function render(): View|string
    {
        return view('components.cashier-product-list', [
            'products' => $this->products
        ]);
    }

    public function showProduct()
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
        }

        return view('product.show', compact('product'));
    }

}
