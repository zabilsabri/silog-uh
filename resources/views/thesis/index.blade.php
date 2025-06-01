@extends('layouts.app')
@section('sidebar', 'True')
@section('title', 'Skripsi')

@section('content')
    <div class="m-3">
        <h3>Daftar Skripsi:</h3>
        <form action="{{ route('thesis') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Masukkan Judul atau Nama Penulis" aria-label="Masukkan Judul atau Nama Penulis" aria-describedby="button-addon2" value="{{ request('search') }}">
            
            <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-addon2">
                <i class="fi fi-rs-search"></i>
            </button>
            </form>

            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Filter
            </button>

            @if(request()->has('search') || request()->has('title') || request()->has('author') || request()->has('year'))
                <a href="{{ route('thesis') }}" class="btn btn-sm btn-outline-danger">
                    Clear Filter
                </a>
            @endif
        </div>
        <hr>
        <div class="font-smaller">
            @foreach($thesis as $thesis_list)
            <p>
                {{ $thesis_list->user->last_name }}, {{ $thesis_list->user->first_name }} ({{ $thesis_list->year }}) 
                <a class="fst-italic" href="{{ route('thesis.detail', ['id' => $thesis_list->id]) }}">{{ $thesis_list->title }}</a> 
                ({{ $thesis_list->user->username }})
            </p>
            @endforeach
            @if($thesis->isEmpty())
                <p class="text-muted">Tidak ada data skripsi yang ditemukan.</p>
            @endif
            <div class="d-flex justify-content-end mt-4">
                {{ $thesis->links() }}
            </div>
        </div>
    </div>
    @include('modal.filter-thesis')
@endsection