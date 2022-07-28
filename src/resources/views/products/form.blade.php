<body>
  @csrf
  <image-preview class="mt-2"></image-preview>
  <div class="md-form">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $product->title ?? old('title') }}">
  </div>
  <div class="form-group">
    <label></label>
    <preview-markdown>{{$project->body ?? old('body') }}</preview-markdown>
  </div>
</body>