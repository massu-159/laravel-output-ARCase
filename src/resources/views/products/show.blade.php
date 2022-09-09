@extends('app')

@section('title', 'detail')

@section('content')
@include('nav')
<div class="container col-md-8">
  <div class="card mt-3 border-0">
    <img src="https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->image }}" class="img-fluid shadow rounded" style="max-width: 600px;"/>
    <div class="card-body d-flex flex-row pb-0">
  
      <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class="text-dark grow">
        @if ($product->user->icon_image != null)
        <img src="https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->user->icon_image }}" alt="" style="width: 52px; border-radius: 50%;" class="shadow">
        @else
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        @endif
      </a>
      <div class="card-body pt-0 pb-2">
        <h3 class="h4 card-title pt-2 mb-0">
          <a class="text-dark" href="{{ route('products.show', ['product' => $product]) }}" style="text-decoration:none;">
            {{ $product->title }}
          </a>
        </h3>
        <div>
          <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class="card-text" style="text-decoration:none;">
            {{ $product->user->name }}
          </a>
        </div>
      </div>
      @if( Auth::id() === $product->user_id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button type="button" class="btn btn-link text-muted m-0 p-2">
              <i class="fas fa-ellipsis-v"></i>
            </button>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("products.edit", ['product'=> $product]) }}">
              <i class="fas fa-pen mr-1"></i>Edit
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $product->id }}">
              <i class="fas fa-trash-alt mr-1"></i>Delete
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->
  
      <!-- modal -->
      <div id="modal-delete-{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $product->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      @endif
    </div>
    <div class="pl-2">
      <div class="font-weight-lighter">
        {{ $product->created_at->format('Y/m/d H:i') }}
        <div class="card-body pt-0 pb-2 pl-3">
          <div class="card-text d-flex justify-content-end">
            <div>
              <product-like class="grow" :initial-is-liked-by='@json($product->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($product->count_likes)' :authorized='@json(Auth::check())'
                endpoint="{{ route('products.like', ['product' => $product]) }}">
        
              </product-like>
            </div>
            <div class="card-text">
              <div class="dropdown">
                <a data-toggle="modal" data-target="#modal-share" class="btn btn-link text-muted ml-3 my-0 p-1 grow">
                  <i class="fas fa-share-square"></i>
                </a>
                <div id="modal-share" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
        
                      <div class="modal-body text-center">
                        <!-- Facebook -->
                        <a class="js-sns-link btn mr-3 purple-gradient" href="//www.facebook.com/sharer/sharer.php?t=share" target="_blank"
                          rel="nofollow noopener noreferrer"><i class="fab fa-facebook fa-2x"></i></a>
        
                        <!-- Twitter -->
                        <a class="js-sns-link btn mr-3 purple-gradient" href="//twitter.com/intent/tweet?url={{ url()->full() }}&hashtags=ARCase" target="_blank"
                          rel="nofollow noopener noreferrer"><i class="fab fa-twitter fa-2x"></i></a>
        
                        <!-- LINE -->
                        <a class="js-sns-link btn mr-3 purple-gradient" href="//timeline.line.me/social-plugin/share?url={{ url()->full() }}" target="_blank"
                          rel="nofollow noopener noreferrer"><i class="fab fa-line fa-2x"></i></a>
        
                        <!-- ピンタレスト -->
                        <a class="js-sns-link btn mr-3 purple-gradient" href="//www.pinterest.com/pin/create/button/?url={{ url()->full() }}&media=https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->image }}"
                          target="_blank" rel="nofollow noopener noreferrer"><i class="fab fa-pinterest fa-2x"></i></a>

                          <copy-clipboard :current-url="'{{ url()->full() }}'"></copy-clipboard>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <hr color="#F3F3F3">
    <div class="card-text px-2 py-2">
      <div style="overflow: visible; overflow-wrap: break-word; white-space: pre-wrap;">
        {!! $body !!}
      </div>
    </div>
  </div>
</div>
@endsection