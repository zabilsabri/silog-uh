@extends('layouts.app')
@section('title', 'Profile')
@section('sidebar', 'True')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<style>
    .profile-picture-wrapper {
        position: relative;
        display: inline-block;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 300px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 0%;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
    }

    .overlay .spinner-border {
        width: 2rem;
        height: 2rem;
    }
</style>

<div class="m-3">
    <h3>Profil</h3>
    <div class="welcome-section row font-small gap-3">
        <div class="col-lg-4 home-text">
            <div class="d-flex flex-column text-center">
                <div class="align-items-center profile-picture-wrapper">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture-custom" alt="Profile Picture">

                    <div id="spinnerOverlay" class="overlay align-items-center">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <button type="button" id="uploadProfile" class="btn btn-sm btn-outline-primary mt-2">Ubah Foto</button>
                <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#editProfile">Edit Profil</button>

                <form id="uploadForm" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="profile_picture" id="hiddenFileInput" accept="image/*">
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama:</label>
                    <p class="m-0">{{ (Auth::user()->first_name && Auth::user()->last_name) ? Auth::user()->first_name . " " . Auth::user()->last_name : '-' }}</p>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">NIM:</label>
                <input type="text" class="form-control" value="{{ Auth::user()->username }}" disabled>
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label">Judul Skripsi:</label>
                <p class="m-0">"{{ Auth::user()->thesis->title ?? '-' }}"</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Pembimbing Utama:</label>
                <p class="m-0">{{ Auth::user()->thesis->supervisor ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Penguji:</label>
                <ol>
                    @forelse (Auth::user()->thesis->examiner ?? [] as $examinerList)
                        <li><p class="mb-1">{{ $examinerList->name }}</p></li>
                    @empty
                        <li><p class="mb-1">-</p></li>
                    @endforelse
                </ol>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun:</label>
                <p class="m-0">{{ Auth::user()->thesis->year ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">File Skripsi:</label>
                <a href="{{ asset('storage/'.Auth::user()?->thesis?->file_path ?? '') }}">{{ Auth::user()->thesis->file_name ?? '' }}</a>
            </div>
        </div>
    </div>
</div>

@include('modal.edit-profile')

<script>
    document.getElementById('uploadProfile').addEventListener('click', function () {
        document.getElementById('hiddenFileInput').click();
    });

    document.getElementById('hiddenFileInput').addEventListener('change', function () {
        if (this.files.length > 0) {
            // Show overlay and spinner
            document.getElementById('spinnerOverlay').style.display = 'flex';

            // Disable upload button
            document.getElementById('uploadProfile').disabled = true;

            // Submit the form
            document.getElementById('uploadForm').submit();
        }
    });
</script>
@endsection
