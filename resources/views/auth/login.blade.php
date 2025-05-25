@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg mt-5 p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">NIM/Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usernameInput = document.getElementById('username');
            usernameInput.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });

            const passwordInput = document.getElementById('password');
            passwordInput.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    </script>
@endsection