@extends('app')

@section('title', $user->name . 'のお気に入り')

@section('content')
@include('nav')
<div class="container">
  @include('users.user')

  <ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
      <a class="nav-link text-muted" href="{{ route('users.show', ['name' => $user->name]) }}">
        Products
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted active" href="{{ route('users.likes', ['name' => $user->name]) }}">
        お気に入り
      </a>
    </li>
  </ul>
  @foreach($products as $product)
  @include('products.card')
  @endforeach
</div>
@endsection