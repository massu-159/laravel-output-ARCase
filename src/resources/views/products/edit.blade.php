@extends('app')

@section('title', 'エディット')

@include('nav')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          @include('error_card_list')
          <div class="card-text">
            <form method="POST" action="{{ route('products.update', ['product' => $product]) }}"
              enctype="multipart/form-data">
              @method("PATCH")
              @include('products.editForm')
              <div class="text-center">
                <button type="submit" class="btn purple-gradient grow">更新する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection