@extends('app')

@section('title', 'アップロード')

@include('nav')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card border-0">
        <div class="card-body pt-0 px-0">
          @include('error_card_list')
          <div class="card-text">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
              @include('products.form')
              <div class="text-center">
                <button type="submit" class="btn purple-gradient grow">アップロードする</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection