<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<div id="mySidebar" class="sidebar bg-white p-2 rounded font-small">
    <div class="sidebar-header rounded-4 mb-3">
        <p class="p-0 m-0">Halo,</p>
        <p class="p-0 m-0 fw-bolder">Selamat Datang</p>
    </div>
    @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('home-admin') }}" class="{{ request()->routeIs('home-admin') ? 'active' : '' }} my-1"><span class="ps-3 font-small"><i class="fi fi-rs-house-chimney me-2"></i>Dashboard</span></a>
        <a href="{{ route('students.admin') }}" class="{{ request()->routeIs('students.admin') || request()->routeIs('students.detail.admin') ? 'active' : '' }} my-1"><span class="ps-3 font-small"><i class="fi fi-rr-users-alt me-2"></i>Mahasiswa</span></a>
    @else
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }} my-1"><span class="ps-3 font-small"><i class="fi fi-rs-house-chimney me-2"></i>Beranda</span></a>
    @endif
    <a href="{{ route('thesis') }}" class="{{ request()->routeIs('thesis') || request()->routeIs('thesis.detail') ? 'active' : '' }} my-1"><span class="ps-3 font-small"><i class="fi fi-rs-document me-2"></i>Skripsi</span></a>
    <hr>
    @if(Auth::check() && Auth::user()->role == 'admin')
    @else
        <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }} my-1"><span class="ps-3 font-small"><i class="fi fi-rs-user me-2"></i>Akun</span></a>
    @endif
    <a href="#" class="my-1"><span class="ps-3 font-small"><i class="fi fi-rs-book me-2"></i>Tutorial</span></a>
</div>