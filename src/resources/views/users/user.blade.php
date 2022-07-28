<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if ( Auth::id() === $user->id )

      <a data-toggle="modal" data-target="#modal-icon" class="grow">
        @if ($user->icon_image != null)
        <img src="{{ asset('storage/img/' . $user->icon_image) }}" alt="アイコン画像" style="width: 60px; border-radius: 50%;">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      <div id="modal-icon" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              @include('users.editprofile')
            </div>
          </div>
        </div>
      </div>

      @else

      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark grow">
        @if ($user->icon_image != null)
            <img src="{{ asset('storage/img/' . $user->icon_image) }}" alt="アイコン画像" style="width: 60px; border-radius: 50%;">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      @endif

      @if( Auth::id() !== $user->id )
      <follow-button class="ml-auto grow" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
        :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
      </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark" style="text-decoration:none;">
        {{ $user->name }}
      </a>
    </h2>
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted grow" style="text-decoration:none;">
        {{ $user->count_followings }} follow
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted grow pl-2" style="text-decoration:none;">
        {{ $user->count_followers }} follower
      </a>
    </div>
  </div>
</div>