# laravel-output-ARCase
Laravelを使ったSNSアプリケーション
<img width="1418" alt="画像" src="https://user-images.githubusercontent.com/75517054/195033903-22d28b59-d2f8-4b3c-9db4-92c3c8d34d26.png">

フロントは、主にBlade。一部コンポーネントをVueを使用（CSR）。

レスポンシブ。

Dockerで開発環境を構築。

~~Herokuにデプロイ。~~
現在閉鎖中

<hr>

urlはこちら
https://github.com/massu-159/laravel-output-ARCase

## アプリケーションの仕様

### 1. 仕様
- sns記事投稿
  - sns記事一覧表示
  - sns記事新規投稿処理
  - sns記事更新処理
  - sns記事削除処理
  - sns記事いいね処理
- フォロー
  - フォロー(アンフォロー)
- 認証
  - 会員登録
  - ログイン(ログアウト)
  - パスワード再設定(メール送信)

### 2. 構成技術
- nginx : "1.18"
- php : "^7.4 | ^8.0"
- composer : "2.2"
- laravel : "^8.12"
- vue : "^3.2"
- node.js : "12.14"
- MySQL : "8.0"
- S3(AWS)
- marked : "^4.0.18"
- bootstrap : "^4.0"

## 備考
ルーティングの一覧を表示するコマンド
```
php artisan route:list
```
