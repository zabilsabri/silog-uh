@extends('layouts.app')
@section('title', 'Profile')
@section('sidebar', 'True')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="m-3">
    <h3>Profil</h3>
    <div class="welcome-section row font-small gap-3" id="post-{{ $user->thesis->id ?? '' }}">
        <div class="col-lg-4 home-text">
            <div class="d-flex flex-column text-center">
                <div class="align-items-center profile-picture-wrapper">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture-custom" alt="Profile Picture">
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama:</label>
                    <p class="m-0">{{ ($user->first_name && $user->last_name) ? $user->first_name . " " . $user->last_name : '-' }}</p>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">NIM:</label>
                <input type="text" class="form-control" value="{{ $user->username }}" disabled>
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label">Judul Skripsi:</label>
                <p class="m-0">
                    {{ $user->thesis?->title ? '"' . $user->thesis->title . '"' : '-' }}
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label">Pembimbing Utama:</label>
                <p class="m-0">{{ $user->thesis->supervisor ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Penguji:</label>
                @if(!empty($user->thesis->examiner))
                    <ol>
                        @foreach ($user->thesis->examiner as $examinerList)
                            <li><p class="mb-1">{{ $examinerList->name }}</p></li>
                        @endforeach
                    </ol>
                @else
                    <p class="mb-1">-</p>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun:</label>
                <p class="m-0">{{ $user->thesis->year ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">File Skripsi:</label>
                @if(!empty($user->thesis->file_path))
                    <a href="{{ asset('storage/'.$user->thesis->file_path) }}">{{ $user->thesis->file_name }}</a>
                @else
                    <p class="mb-1">-</p>
                @endif
            </div>
            @if(!empty($user->thesis->source_code))
                <div class="mb-3">
                    <label for="source_code">Source Code:</label>
                    <a href="{{ asset('storage/'.$user->thesis->source_code ?? '') }}">{{ $user->thesis->source_code ?? '' }}</a>
                </div>
            @endif
            @if(!empty($user->thesis->data_source))
                <div class="mb-3">
                    <label for="data_source">Sumber Data:</label>
                    <a href="{{ asset('storage/'.$user->thesis->data_source ?? '') }}">{{ $user->thesis->data_source ?? '' }}</a>
                </div>
            @endif
            <div class="mb-3">
                <h6>Abstrak:</h6>
                @if($user->thesis)
                    @if(strlen(strip_tags($user->thesis->abstract)) > 250)
                        <p style="text-align: justify;" class="card-text font-smaller short-description m-0">{{ Str::limit(strip_tags($user->thesis->abstract), 250, '') }}<span class="ellipsis-readmore font-smaller" data-post-id="{{ $user->thesis->id }}">... Read More</span></p>
                    @else
                        <span class="card-text font-smaller">{{ $user->thesis->abstract }}</span>
                    @endif
                    <p style="text-align: justify;" class="font-smaller full-description d-none">{{ $user->thesis->abstract }}</p>
                @else
                    <p>-</p>
                @endif
            </div>
            @if(!empty($user->thesis->source_code_path) || !empty($user->thesis->source_code_name) || !empty($user->thesis->file_data_source_path) || !empty($user->thesis->file_data_source_name) || !empty($user->thesis->link_data_source))
            <div class="mb-3">
                <div class="border rounded font-smaller p-3">
                    <h6>Lampiran:</h6>
                    @if($user->thesis->source_code_path && $user->thesis->source_code_name)
                    <div class="mb-2">
                        <label for="form-label">Source Code:</label>
                        <a href="{{ asset('storage/'.$user->thesis->source_code_path) }}">{{ $user->thesis->source_code_name }}</a>
                    </div>
                    @endif
                    @if($user->thesis->file_data_source_path && $user->thesis->file_data_source_name)
                    <div class="mb-2">
                        <label for="form-label">Sumber Data:</label>
                        <a href="{{ asset('storage/'.$user->thesis->file_data_source_path) }}">{{ $user->thesis->file_data_source_name }}</a>
                    </div>
                    @endif
                    @if($user->thesis->link_data_source)
                    <div class="mb-2">
                        <label for="form-label">Link Sumber Data:</label>
                        <a href="{{$user->thesis->link_data_source}}">{{ $user->thesis->link_data_source }}</a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/showmore.js') }}"></script>
@endsection
