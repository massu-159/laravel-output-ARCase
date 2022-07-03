<!DOCTYPE html>
<html lang="ja">

<head>

  <style>
    .imagePreview {
      width: 300px;
      height: 220px;
      background-position: center center;
      background-size: cover;
      -webkit-box-shadow: 0 0 1px 1px rgba(195, 195, 195, 0.3);
      display: inline-block;
      margin: 10px auto;
      background-image: url({{ Storage::url($product->image) }});
    }
  </style>
</head>

<body>
  @csrf
  <div class="imagePreview"></div>
  <div class="input-group">
    <label class="input-group-btn">
      <span class="btn blue-gradient btn-block">
        UPLOAD<input type="file" name="image" style="display:none" class="uploadFile"
          accept="image/png,image/jpeg,image/gif">
      </span>
    </label>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    $(document).on('change', ':file', function() {
            var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.parent().parent().next(':text').val(label);

            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function(){ // set image data as background of div
                    input.parent().parent().parent().prev('.imagePreview').css("background-image", "url("+this.result+")");
                }
            }
        });
  </script>

  <div class="md-form">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $product->title ?? old('title') }}">
  </div>
  <div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="16"
      placeholder="本文">{{ $product->body ?? old('body') }}</textarea>
  </div>
</body>

</html>