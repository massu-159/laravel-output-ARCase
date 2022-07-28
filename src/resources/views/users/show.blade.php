@extends('app')

@section('title', $user->name)

@section('content')
@include('nav')
<div class="container">
  @include('users.user')

  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
      <a class="nav-link text-muted active" href="{{ route('users.show', ['name' => $user->name]) }}">
        Products
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted" href="{{ route('users.likes', ['name' => $user->name]) }}">
        お気に入り
      </a>
    </li>
  </ul>
  <div style="justify-content: center; display: flex; flex-direction: row; flex-wrap: wrap;">
    @foreach ($products as $product)
    @include('products.card')
    @endforeach
  </div>
</div>
@endsection