@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container">
  @foreach ($products as $product)
  <div class="card mt-3">
    <img src="{{ asset($product->image) }}" class="img-fluid" />
    <div class="card-body d-flex flex-row pb-0">
      <i class="fas fa-user-circle fa-3x mr-1"></i>
      <div class="card-body pt-0 pb-2">
        <h3 class="h4 card-title pt-2">
          {{ $product->title }}
        </h3>
      </div>
    </div>
    <div class="pl-2">
      <div class="font-weight-normal">
        {{ $product->user->name }}
      </div>
      <div class="font-weight-lighter">
        {{ $product->created_at->format('Y/m/d H:i') }}
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection