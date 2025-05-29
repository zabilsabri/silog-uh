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
    @if ($errors->any())
        <div class="alert alert-danger font-smaller">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="welcome-section row font-small gap-3" id="post-{{ Auth::user()->thesis->id ?? '' }}">
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
                <button type="button" class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#editProfile">Upload Skripsi</button>

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
                <p class="m-0">
                    {{ Auth::user()->thesis?->title ? '"' . Auth::user()->thesis->title . '"' : '-' }}
                </p>            
            </div>
            <div class="mb-3">
                <label class="form-label">Pembimbing Utama:</label>
                <p class="m-0">{{ Auth::user()->thesis->supervisor ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Penguji:</label>
                @if(!empty(Auth::user()->thesis->examiner))
                <ol>
                    @foreach (Auth::user()->thesis->examiner as $examinerList)
                        <li><p class="mb-1">{{ $examinerList->name }}</p></li>
                    @endforeach
                </ol>
                @else
                    <p class="mb-1">-</p>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun:</label>
                <p class="m-0">{{ Auth::user()->thesis->year ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">File Skripsi:</label>
                @if(!empty(Auth::user()->thesis->file_path))
                    <a href="{{ asset('storage/'.Auth::user()->thesis->file_path) }}">{{ Auth::user()->thesis->file_name }}</a>
                @else
                    <p class="mb-1">-</p>
                @endif
            </div>
            @if(!empty(Auth::user()->thesis->source_code_path) && !empty(Auth::user()->thesis->source_code_name))
            <div class="mb-3">
                <label class="form-label">Source Code:</label>
                <a href="{{ asset('storage/'.Auth::user()->thesis->source_code_path) }}">{{ Auth::user()->thesis->source_code_name }}</a>
            </div>
            @endif
            @if(!empty(Auth::user()->thesis->file_data_source_path) && !empty(Auth::user()->thesis->file_data_source_name))
            <div class="mb-3">
                <label class="form-label">Sumber Data:</label>
                <a href="{{ asset('storage/'.Auth::user()->thesis->file_data_source_path) }}">{{ Auth::user()->thesis->file_data_source_name }}</a>
            </div>
            @endif
            @if(!empty(Auth::user()->thesis->link_data_source))
            <div class="mb-3">
                <label class="form-label">Link Sumber Data:</label>
                <a href="{{ Auth::user()->thesis->link_data_source }}">{{ Auth::user()->thesis->link_data_source }}</a>
            </div>
            @endif
            <div class="mb-3 font-smaller" style="text-align: justify;" >
                <label class="form-label">Abstrak:</label>
                @if(!empty(Auth::user()->thesis->abstract))
                    @if(strlen(strip_tags(Auth::user()->thesis->abstract)) > 250)
                        <p class="card-text short-description m-0">{{ Str::limit(strip_tags(Auth::user()->thesis->abstract), 250, '') }}<span class="ellipsis-readmore" data-post-id="{{ Auth::user()->thesis->id }}">... Read More</span></p>
                    @else
                        <span class="card-text">{{ Auth::user()->thesis->abstract }}</span>
                    @endif
                    <p class="full-description font d-none">{{ Auth::user()->thesis->abstract ?? '-' }}</p>
                @else
                    <p class="card-text">-</p>
                @endif
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
<script src="{{ asset('js/showmore.js') }}" ></script>
@endsection
