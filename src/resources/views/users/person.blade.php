<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark grow">
        @if ($person->icon_image != null)
        <img src="{{ asset('storage/img/' . $person->icon_image) }}" alt="アイコン画像" style="width: 52px; border-radius: 50%;">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      @if( Auth::id() !== $person->id )
      <follow-button class="ml-auto grow"
        :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
        :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $person->name]) }}"
      >
      </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark" style="text-decoration:none;">{{ $person->name }}</a>
    </h2>
  </div>
</div>