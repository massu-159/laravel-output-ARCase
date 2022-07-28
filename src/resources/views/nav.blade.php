<nav class="navbar navbar-expand navbar-dark purple-gradient fixed-top bg-transparent shadow-lg">

  <a class="navbar-brand" href="/"><img class="mr-1 pb-1" src="{{ asset('img/ARCase.png') }}" alt="" style="width: 32px;"/>ARCase</a>

  <ul class="navbar-nav ml-auto">

    @guest
    <li class="nav-item">
      <a class="nav-link font-weight-bold grow" href="{{ route('register') }}">Sign up</a>
    </li>
    @endguest
    
    @guest
    <li class="nav-item">
      <a class="nav-link border rounded-lg font-weight-bold grow" href="{{ route('login') }}">Log in</a>
    </li>
    @endguest
    
    @auth
    <li class="nav-item">
      <a class="nav-link font-weight-bold grow" href="{{ route('products.create') }}"><i class="fas fa-pen mr-1"></i>Upload</a>
    </li>
    @endauth

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle grow" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        @if (Auth::user()->icon_image != null)
        <img src="{{ asset('storage/img/' . Auth::user()->icon_image) }}" alt="" style="width: 28px; border-radius: 50%;">
        @else
        <i class="fas fa-user-circle fa-lg"></i>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
          My page
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          Log out
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth


  </ul>

</nav>