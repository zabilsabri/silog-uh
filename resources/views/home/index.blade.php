@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <div class="m-3">
        <div class="welcome-section row font-small gap-5">
            <div class="col-lg-7 home-text">
                <h3>Skripsi Sistem Informasi Universitas Hasanuddin</h3>
                <p>Kami dengan bangga mempersembahkan SILog, sebuah platform digital yang dirancang khusus untuk mendukung proses akademik mahasiswa Program Studi Sistem Informasi.</p>
                <p>Melalui SILog, kami menghadirkan sebuah sistem yang terintegrasi, transparan, dan efisien dalam mengelola karya ilmiah berupa skripsi, sebagai bagian dari komitmen kami terhadap kualitas dan akuntabilitas pendidikan tinggi.</p>
                <p>SILog bertujuan untuk menjadi pusat arsip skripsi mahasiswa Sistem Informasi yang mudah diakses, baik oleh kepala lab, maupun sesama mahasiswa. SILog diharapkan menjadi jembatan antara proses akademik dan perkembangan teknologi informasi di lingkungan kampus.</p>
            </div>
            <div class="col-lg-4 text-center">
                <img src="{{ asset('image/silog-logo-only.png') }}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-sm btn-primary" type="button">Unggah Skripsi</button>
        </div>
    </div>
@endsection