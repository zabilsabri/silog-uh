<nav class="navbar border-bottom bg-white">
  <div class="container" style="padding-left: 15px !important;">
    <a class="navbar-brand" style="margin-right: 0px" href="{{ route('home') }}">
        <img src="{{ asset('image/silog-logo.png') }}" style="object-fit: cover; overflow: hidden;" alt="Bootstrap" class="img-navbar" width="105" height="40">
    </a>
    <div class="dropdown" style="padding-right: 15px !important;">
        <a href="" data-bs-toggle="dropdown" class="dropdown-toggle link-underline link-underline-opacity-0 border p-2 rounded-pill border-primary" style="color: #003370; !important" aria-expanded="false">
          @if(Auth::check())
            <img src="{{ (Auth::user()->profile_picture == null) ? asset('image/profile-picture/profile-picture-default.jpg') : asset('storage/' . Auth::user()->profile_picture) }}" class="object-fit-cover profile-picture" alt="Profile Picture" width="30" height="30">
          @else
            <img src="{{ asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture" alt="Profile Picture" width="30" height="30">
          @endif
        </a>
        <ul class="dropdown-menu font-smaller">
          @if(Auth::check())
          <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
          <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
          @else
          <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
          @endif
        </ul>
      </div>
  </div>
</nav>