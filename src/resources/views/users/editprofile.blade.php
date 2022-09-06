<div class="card-text">
  <form action="{{ route('users.update', ['user' => $user]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @if ($user->icon_image != null)
    <icon-preview :back-ground="'https://arcase.s3.ap-northeast-1.amazonaws.com/{{ $user->icon_image }}'"></icon-preview>
    @else
    <icon-preview-default></icon-preview-default>
    @endif
    <div class="md-form">
      <label>User Name</label>
      <input type="text" name="name" value='{{ $user->name }}' class="form-control">
    </div>
    <input type='submit' value='更新' class="btn purple-gradient grow">
  </form>
</div>