<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h1 class="text-center"><a class="text-dark" href="/"><img class="mr-1 pb-1"
                        src="{{ asset('img/ARCase.png') }}" alt="" style="width: 40px;"/>ARCase</a></h1>
            <div class="card mt-3">
                <div class="alert alert-danger" role="alert">
                    現在、新規登録は使用できない状態にしております。
                </div>
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">Sign Up</h2>

                    @include('error_card_list')

                    <div class="card-text">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="md-form">
                                <label for="name">ユーザー名</label>
                                <input class="form-control" type="text" id="name" name="name" required
                                    value="{{ old('name') }}">
                                <small>2〜32文字(登録後に変更ができます)</small>
                            </div>
                            <div class="md-form">
                                <label for="email">メールアドレス</label>
                                <input class="form-control" type="text" id="email" name="email" required
                                    value="{{ old('email') }}">
                            </div>
                            <div class="md-form">
                                <label for="password">パスワード</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                            <div class="md-form">
                                <label for="password_confirmation">パスワード(確認)</label>
                                <input class="form-control" type="password" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                            <button class="btn btn-block purple-gradient mt-2 mb-2" type="submit" disabled>ユーザー登録</button>
                        </form>

                        <div class="mt-0">
                            <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
