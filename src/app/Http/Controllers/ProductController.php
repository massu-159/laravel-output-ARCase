<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $user = Auth::user();

        return view('products.index', compact('products', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('products.create', ['user' => $user]);
    }

    public function edit(Product $product)
    {
        $user = Auth::user();
        return view('products.edit', [
            'product' => $product,
            'user' => $user,
        ]);
    }
    
    public function show(Product $product)
    {
        $html = Str::of($product->body)->markdown([
            'html_input' => 'escape',
        ]);
        $user = Auth::user();
        return view('products.show', [
            'product' => $product,
            'body' => $html,
            'user' => $user,
    ]);
    }

    // 登録処理
    public function store(ProductRequest $request, Product $product)
    {
        
        // リクエストした画像を取得
        $file = $request->file('image');
        if (isset($file)) {
            //画像の拡張子取得
            $extension = $request->image->extension();
            //新しいファイル名作成
            $img_name = uniqid(mt_rand()) . '.' . $extension;
            // サイズを変更する
            $img = Image::make($file)->fit(640, 360, function($constraint){
                $constraint->upsize();
            });
            // リサイズした画像をstorageに保存
            $img->save(storage_path() . '/app/public/img/' . $img_name);
            // DBに登録
            $product->image = $img_name;
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
        $file = $request->file('image');
        if (isset($file)) {
            //画像の拡張子取得
            $extension = $request->image->extension();
            //新しいファイル名作成
            $img_name = uniqid(mt_rand()) . '.' . $extension;
            // サイズを変更する
            $img = Image::make($file)->fit(640, 360, function($constraint){
                $constraint->upsize();
            });
            // リサイズした画像をstorageに保存
            $img->save(storage_path() . '/app/public/img/' . $img_name);
            // DBに登録
            $product->image = $img_name;
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
