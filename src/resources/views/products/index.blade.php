@extends('app')

@section('title', 'library')

@section('content')
@include('nav')
<div class="container">
  <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
    @foreach ($products as $product)
      @include('products.card')
    @endforeach
  </div>
</div>
@endsection