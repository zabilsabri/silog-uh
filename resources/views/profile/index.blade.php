@extends('layouts.app')
@section('title', 'Profile')
@section('sidebar', 'True')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="m-3">
        <h3>Profil</h3>
        <div class="welcome-section row font-small gap-3">
            <div class="col-lg-4 home-text">
                <div class="d-flex flex-column text-center">
                    <div class="align-items-center">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture" width="220" height="220" alt="">
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
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput" class="form-label">Nama: </label>
                            <p class="m-0">{{ (Auth::user()->first_name && Auth::user()->last_name) ? Auth::user()->first_name . " " . Auth::user()->last_name : '-' }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">NIM: </label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" value="{{ Auth::user()->username }}" placeholder="Masukkan NIM" disabled>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Judul Skripsi: </label>
                        <p class="m-0">"{{ Auth::user()->thesis->title ?? '-' }}"</p>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Pembimbing Utama: </label>
                        <p class="m-0">{{ Auth::user()->thesis->supervisor ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Penguji: </label>
                        <ol>
                            @forelse (Auth::user()->thesis->examiner as $examinerList)
                                <li>
                                    <p class="mb-1">{{ $examinerList->name }}</p>
                                </li>
                            @empty
                                <li>
                                    <p class="mb-1">Tidak ada penguji yang ditambahkan</p>
                                </li>
                            @endforelse
                        </ol>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Tahun: </label>
                        <p class="m-0">{{ Auth::user()->thesis->year ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">File Skripsi: </label>
                        <a href="{{ asset('storage/'.Auth::user()->thesis->file_path) }}">{{ Auth::user()->thesis->file_name ?? '-' }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('modal.edit-profile')
    <script>
        document.getElementById('uploadProfile').addEventListener('click', function () {
            document.getElementById('hiddenFileInput').click();
        });

        document.getElementById('hiddenFileInput').addEventListener('change', function () {
            // Auto-submit the form when a file is selected
            if (this.files.length > 0) {
                document.getElementById('uploadForm').submit();
            }
        });
    </script>
@endsection