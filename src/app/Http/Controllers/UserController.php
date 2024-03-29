<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class UserController extends Controller
{
    // 表示処理
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load(['products.user', 'products.likes']);

        $products = $user->products->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'products' => $products,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes']);

        $products = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'products' => $products,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    // フォローする・はずす処理
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    // プロフィール更新処理
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $path = $user->icon_image;
        // リクエストした画像を取得
        $file = $request->file('icon_image');
        if (isset($file)) {
            // 元のアイコン画像がある場合、ストレージから削除
            Storage::disk('s3')->delete($path);
            //画像の拡張子取得
            $extension = $request->icon_image->extension();
            //新しいファイル名作成
            $img_name = uniqid(mt_rand()) . '.' . $extension;
            
            $tmp_path = storage_path() . '/app/public/img/' . $img_name;
            // サイズを変更する
            $img = Image::make($file)->fit(320, 320, function ($constraint) {
                $constraint->upsize();
            });
            // リサイズした画像をstorageに一時保存
            $img->save($tmp_path);
            // リサイズした画像をs3に保存
            $s3_save = Storage::disk('s3')->putFile('/', new File($tmp_path), 'public');
            // // s3に保存した画像のURLを取得
            // $s3_path = Storage::disk('s3')->url($s3_save);

            // Storageに一時保存した画像データを削除
            Storage::disk('public')->delete('img/' . $img_name);

            // DBに登録
            $user->icon_image = $s3_save;
        } else {
            $user->icon_image = null;
        }

        $user->name = $request->name;
        $user->save();

        $products = $user->products->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'products' => $products,
        ]);
    }
}
