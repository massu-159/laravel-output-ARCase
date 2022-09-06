<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    // 表示処理
    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(12);
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

            $tmp_path = storage_path() . '/app/public/img/' . $img_name;
            // サイズを変更する
            $img = Image::make($file)->fit(640, 360, function($constraint){
                $constraint->upsize();
            });
            // リサイズした画像をstorageに保存
            $img->save($tmp_path);
            // リサイズした画像をs3に保存
            $s3_save = Storage::disk('s3')->putFile('/', new File($tmp_path), 'public');
            // // s3に保存した画像のURLを取得
            // $s3_path = Storage::disk('s3')->url($s3_save);
            // DBに登録
            $product->image = $s3_save;

            // Storageに一時保存した画像を削除
            Storage::disk('public')->delete('img/' . $img_name);
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
            
            $tmp_path = storage_path() . '/app/public/img/' . $img_name;
            // サイズを変更する
            $img = Image::make($file)->fit(640, 360, function ($constraint) {
                $constraint->upsize();
            });
            // リサイズした画像をstorageに保存
            $img->save($tmp_path);
            // リサイズした画像をs3に保存
            $s3_save = Storage::disk('s3')->putFile('/', new File($tmp_path), 'public');
            // // s3に保存した画像のURLを取得
            // $s3_path = Storage::disk('s3')->url($s3_save);
            
            // Storageに一時保存した画像データを削除
            Storage::disk('public')->delete('img/' . $img_name);

            // 更新前の画像データを削除
            Storage::disk('s3')->delete($product->image);

            // DBに登録
            $product->image = $s3_save;
        }
        $product->fill($request->all());
        $product->save();
        return redirect()->route('products.index');
    }

    // 削除処理
    public function destroy(Product $product)
    {
        // s3内の画像データ削除
        Storage::disk('s3')->delete($product->image);
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
