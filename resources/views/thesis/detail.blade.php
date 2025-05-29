@extends('layouts.app')
@section('title', 'Detail Skripsi')
@section('sidebar', 'True')

@section('content')
    <h4 class="text-center m-2">{{ $thesis->title }}</h4>
    <hr>
    <div class="font-smaller m-3">
        <div class="row" id="post-{{ $thesis->id }}">
            <div class="col-md-7">
                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <p class="m-0">{{ ($thesis->user->first_name && $thesis->user->last_name) ? $thesis->user->first_name . " " . $thesis->user->last_name : '-' }}</p>
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
                @if(Auth::check() && Auth::user()->role == 'admin')
                    <div class="mb-2">
                        <label class="form-label">File Skripsi:</label>
                        <a href="{{ asset('storage/'.$thesis->file_path) }}">{{ $thesis->file_name ?? '-' }}</a>
                    </div>
                @endif
                <div class="mb-3">
                    <h6>Abstrak:</h6>
                    @if(strlen(strip_tags($thesis->abstract)) > 250)
                        <p class="card-text font-smaller short-description m-0">{{ Str::limit(strip_tags($thesis->abstract), 250, '') }}<span class="ellipsis-readmore font-smaller" data-post-id="{{ $thesis->id }}">... Read More</span></p>
                    @else
                        <span class="card-text font-smaller">{{ $thesis->abstract }}</span>
                    @endif
                    <p style="text-align: justify;" class="full-description d-none">{{ $thesis->abstract ?? '-' }}</p>
                </div>
                @if(Auth::check() && Auth::user()->role == 'admin' && ($thesis->source_code_path || $thesis->source_code_name || $thesis->file_data_source_path || $thesis->file_data_source_name || $thesis->link_data_source))
                <div class="mb-3">
                    <div class="border rounded p-2">
                        <h6>Lampiran:</h6>
                        @if($thesis->source_code_path && $thesis->source_code_name)
                        <div class="mb-2">
                            <label for="form-label">Source Code:</label>
                            <a href="{{ asset('storage/'.$thesis->source_code_path) }}">{{ $thesis->source_code_name }}</a>
                        </div>
                        @endif
                        @if($thesis->file_data_source_path && $thesis->file_data_source_name)
                        <div class="mb-2">
                            <label for="form-label">Sumber Data:</label>
                            <a href="{{ asset('storage/'.$thesis->file_data_source_path) }}">{{ $thesis->file_data_source_name }}</a>
                        </div>
                        @endif
                        @if($thesis->link_data_source)
                        <div class="mb-2">
                            <label for="form-label">Link Sumber Data:</label>
                            <a href="{{$thesis->link_data_source}}">{{ $thesis->link_data_source }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ $thesis->user->profile_picture ? asset('storage/' . $thesis->user->profile_picture) : asset('image/profile-picture/profile-picture-default.jpg') }}" class="profile-picture-custom" alt="Profile Picture">
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <a class="btn btn-sm btn-outline-primary mt-2 w-100" href="{{ asset('storage/'.$thesis->file_path) }}" role="button" download>Download PDF</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/showmore.js') }}"></script>
    @include('modal.filter-student')
@endsection
