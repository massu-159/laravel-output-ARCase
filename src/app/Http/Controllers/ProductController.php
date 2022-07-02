<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortByDesc('created_at');

        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->user_id = $request->user()->id;
        $product->save();
        return redirect()->route('products.index');
    }
}
