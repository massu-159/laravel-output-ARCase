<body>
  @csrf
  <image-preview-edit class="mt-2" :back-ground="'https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $product->image }}'"></image-preview-edit>
  <div class="md-form">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $product->title ?? old('title') }}">
  </div>
  <div class="form-group">
    <label></label>
    <preview-markdown :product-body="'{{ json_encode($product->body) }}'"></preview-markdown>
  </div>
</body>
