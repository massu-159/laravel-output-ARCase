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
  <div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
  </div>
</div>
@endsection