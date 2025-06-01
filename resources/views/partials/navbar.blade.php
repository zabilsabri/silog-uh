<nav class="navbar border-bottom bg-white">
  <div class="container" style="padding-left: 15px !important;">
    <a class="navbar-brand" style="margin-right: 0px" href="{{ route('home') }}">
        <img src="{{ asset('image/silog-logo.png') }}" style="object-fit: cover; overflow: hidden;" alt="Bootstrap" class="img-navbar" width="105" height="40">
    </a>
    <span class="right-navbar d-flex flex-row justify-content-evenly">
      <div class="dropdown" style="margin-right: 15px;">
          <a href="" data-bs-toggle="dropdown" class="dropdown-toggle link-underline link-underline-opacity-0 border p-2 rounded-pill border-primary" style="color: #003370; !important" aria-expanded="false">
            @if(Auth::check())
              <img src="{{ (Auth::user()->profile_picture == null) ? asset('image/profile-picture/profile-picture-default.jpg') : asset('storage/' . Auth::user()->profile_picture) }}" class="object-fit-cover profile-picture" alt="Profile Picture" width="30" height="30">
            @else
              <img src="{{ asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture" alt="Profile Picture" width="30" height="30">
            @endif
          </a>
          <ul class="dropdown-menu font-smaller">
            @if(Auth::check())
              @if(Auth::user()->role != 'admin')
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
              @endif
            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
            @else
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
            @endif
          </ul>
        </div>
      </span>
      <button class="btn btn-light navbar-toggler" style="display: none; margin-right: 15px;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header" style="padding-bottom: 10px;">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><img src="{{ asset('image/silog-logo.png') }}" class="img-fluid" alt="Bootstrap" width="170" height="25"></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <div class="list-group mt-2">
      @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('home-admin') }}" class="list-group-item list-group-item-action rounded-0 py-3 {{ request()->routeIs('home-admin') ? 'active' : '' }}" aria-current="true">Dashboard</a>
        <a href="{{ route('students.admin') }}" class="list-group-item list-group-item-action rounded-0 py-3 {{ request()->routeIs('students.admin') ? 'active' : '' }}" aria-current="true">Mahasiswa</a>
      @else
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action rounded-0 py-3 {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="true">Beranda</a>
      @endif
        <a href="{{ route('thesis') }}" class="list-group-item list-group-item-action rounded-0 py-3 {{ request()->routeIs('thesis') ? 'active' : '' }}" aria-current="true">Skripsi</a>
      @if(Auth::check() && Auth::user()->role == 'admin')
      @else
        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action rounded-0 py-3 {{ request()->routeIs('profile') ? 'active' : '' }}" aria-current="true">Akun</a>
      @endif
      <a href="#" class="list-group-item list-group-item-action rounded-0 py-3" aria-current="true">Tutorial</a>
      @if(Auth::check())
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action py-3 rounded-0 text-danger">Logout</a>
      @endif
    </div>
  </div>
</div>