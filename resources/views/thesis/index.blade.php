@extends('layouts.app')
@section('sidebar', 'True')
@section('title', 'Skripsi')

@section('content')
    <div class="m-3">
        <h3>Daftar Skripsi:</h3>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan Judul atau Nama Penulis" aria-label="Masukkan Judul atau Nama Penulis" aria-describedby="button-addon2">
            <button class="btn btn-sm btn-outline-secondary" type="button" style="padding-top: 10px;" id="button-addon2"><i class="fi fi-rs-search"></i></button>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button" id="button-addon2">Filter</button>
        </div>
        <hr>
        <div class="font-smaller">
            @foreach($thesis as $thesis_list)
            <p>
                {{ $thesis_list->user->last_name }}, {{ $thesis_list->user->first_name }} ({{ $thesis_list->year }}) 
                <a class="fst-italic" href="#">{{ $thesis_list->title }}</a> 
                ({{ $thesis_list->user->username }})
            </p>
            @endforeach
            @if($thesis->isEmpty())
                <p class="text-muted">Tidak ada data skripsi yang ditemukan.</p>
            @endif
            <div class="d-flex justify-content-center mt-4">
                {{ $thesis->links() }}
            </div>
        </div>
    </div>
    @include('modal.filter-thesis')
@endsection