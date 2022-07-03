@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container">
  @foreach ($products as $product)
    @include('products.card')
  @endforeach
</div>
@endsection