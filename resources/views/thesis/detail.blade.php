@extends('layouts.app')
@section('title', 'Detail Skripsi')
@section('sidebar', 'True')

@section('content')
    <h4 class="text-center m-2">{{ $thesis->title }}</h4>
    <hr>
    <div class="font-smaller m-3">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama:</label>
                        <p class="m-0">{{ ($thesis->user->first_name && $thesis->user->last_name) ? $thesis->user->first_name . " " . $thesis->user->last_name : '-' }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">NIM:</label>
                    <input type="text" class="form-control" value="{{ $thesis->user->username }}" disabled>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Pembimbing Utama:</label>
                    <p class="m-0">{{ $thesis->supervisor ?? '-' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penguji:</label>
                    <ol>
                        @forelse ($thesis->examiner as $examinerList)
                            <li><p class="mb-1">{{ $examinerList->name }}</p></li>
                        @empty
                            <li><p class="mb-1">Tidak ada penguji yang ditambahkan</p></li>
                        @endforelse
                    </ol>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun:</label>
                    <h5><span class="badge text-bg-secondary">{{ $thesis->year ?? '-' }}</span></h5>
                </div>
                <div class="mb-3">
                    <label class="form-label">File Skripsi:</label>
                    <a href="{{ asset('storage/'.$thesis->file_path) }}">{{ $thesis->file_name ?? '-' }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ $thesis->user->profile_picture ? asset('storage/' . $thesis->user->profile_picture) : asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture-custom" alt="Profile Picture">
                    <a class="btn btn-sm btn-outline-primary mt-2 w-100" href="{{ asset('storage/'.$thesis->file_path) }}" role="button" download>Download PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection
