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
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
            <p>Sabri, Zabil (2025) <a class="fst-italic" href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, vero? Aspernatur, porro saepe quasi distinctio est iure optio labore? Distinctio fugit, sed sequi modi vel neque! Dolorum quidem adipisci magni.</a> (H071211016)</p>
        </div>
    </div>
    @include('modal.filter-thesis')
@endsection