<div class="card mt-4 mr-3 px-0 grow col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="min-width: 250px;">
    <a class="img-fluid" href="{{ route('products.show', ['product' => $product]) }}">
      <img src="https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->image }}" class="img-fluid rounded shadow" />
    </a>
  <div class="card-body d-flex flex-row pb-0 pt-1 pr-0">
    <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class="text-dark">
      @if ($product->user->icon_image != null)
      <img src="https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->user->icon_image }}" alt="" style="width: 52px; border-radius: 50%;" class="shadow">
      @else
      <i class="fas fa-user-circle fa-3x mr-1"></i>
      @endif
    </a>
    <div class="card-body py-0" style="overflow: hidden; width: 100%;">
      <h3 class="h6 mt-1 mb-0 text-dark" style="overflow: hidden; display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;">
        <a class="text-dark" href="{{ route('products.show', ['product' => $product]) }}" style="text-decoration:none;">
          {{ $product->title }}
        </a>
      </h3>
        <div class="mt-1" style="overflow: hidden; width: 100%;">
          <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class=" font-weight-lighter text-muted" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-decoration:none;">
            {{ $product->user->name }}
          </a>
        </div>
    </div>
    @if( Auth::id() === $product->user_id )
    <!-- dropdown -->
    <div class="ml-auto card-text pl-2 mt-2 mr-2">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-link text-muted m-0 p-0">
            <i class="fas fa-ellipsis-v"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right py-0">
          <a class="dropdown-item" href="{{ route("products.edit", ['product'=> $product]) }}">
            <i class="fas fa-pen mr-1"></i>Edit
          </a>
          <div class="dropdown-divider my-0"></div>
          <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $product->id }}">
            <i class="fas fa-trash-alt mr-1"></i>Delete
          </a>
        </div>
      </div>
    </div>
    <!-- dropdown -->
    @endif
  </div>
  <div class="pl-3">
    <div class="font-weight-lighter d-flex text-muted">
      {{ $product->created_at->format('Y/m/d H:i') }}
    </div>
  </div>
</div>

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
          <button type="submit" class="btn btn-danger">削除する</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal -->