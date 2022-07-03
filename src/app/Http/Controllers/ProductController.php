<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    // 表示処理
    public function index()
    {
        $products = Product::all()->sortByDesc('created_at')->load('user', 'likes');

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }
    
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    // 登録処理
    public function store(ProductRequest $request, Product $product)
    {
        
        // リクエストした画像を取得
        $img = $request->file('image');
        if (isset($img)) {
            // storageに保存
            $imgPath = $request->image->store('img', 'public');
            if ($imgPath) {
                // DBに登録
                $product->image = $imgPath;
            }
        }
        $product->fill($request->all());
        $product->user_id = $request->user()->id;
        $product->save();
        return redirect()->route('products.index');
    }

    // 更新処理
    public function update(ProductRequest $request, Product $product)
    {
        // リクエストした画像を取得
        $img = $request->file('image');
        if (isset($img) && $img != 'default1234.png') {
            // storageに保存
            $imgPath = $request->image->store('img', 'public');
            if ($imgPath) {
                // DBに登録
                $product->image = $imgPath;
            }
        }
        $product->fill($request->all());
        $product->save();
        return redirect()->route('products.index');
    }

    // 削除処理
    public function destroy(Product $product)
    {
        // storage内の画像データ削除
        Storage::disk('public')->delete($product->image);
        // DB内のプロダクトデータ削除
        $product->delete();
        return redirect()->route('products.index');
    }

    // いいね機能
    public function like(Request $request, Product $product)
    {
        $product->likes()->detach($request->user()->id);
        $product->likes()->attach($request->user()->id);

        return [
            'id' => $product->id,
            'countLikes' => $product->count_likes,
        ];
    }

    public function unlike(Request $request, Product $product)
    {
        $product->likes()->detach($request->user()->id);

        return [
            'id' => $product->id,
            'countLikes' => $product->count_likes,
        ];
    }

}
