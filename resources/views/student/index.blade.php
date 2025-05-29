@extends('layouts.app')
@section('sidebar', 'True')
@section('title', 'Mahasiswa')

@section('content')
    <div class="m-3">
        <h3>Data Mahasiswa</h3>
        <form action="{{ route('students.admin') }}" method="GET" class="d-flex">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Masukkan Nama atau NIM" aria-label="Masukkan Judul atau Nama Penulis" aria-describedby="button-addon2" value="{{ request('search') }}">
            
            <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-addon2">
                <i class="fi fi-rs-search"></i>
            </button>
            </form>

            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#studentModal">
                Filter
            </button>

            @if(request()->has('search') || request()->has('name') || request()->has('username') || request()->has('status'))
                <a href="{{ route('students.admin') }}" class="btn btn-sm btn-outline-danger">
                    Clear Filter
                </a>
            @endif
        </div>
        <div class="table-container">
            <table class="table table-bordered font-smaller">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <th scope="row" class="text-center" style="width: 50px">{{ $index + 1 }}</th>
                            <td>{{ ($user->first_name && $user->last_name) ? $user->first_name . " " . $user->last_name : '-' }}</td>
                            <td>{{ $user->username }}</td>
                            @if($user->thesis)
                                <td><h6><span class="badge text-bg-success">Sudah Upload</span></h6></td>
                            @else
                                <td><h6><span class="badge text-bg-danger">Belum Upload</span></h6></td>
                            @endif
                            <td style="width: 150px;">
                                <div class="d-grid gap-2 d-md-block">
                                    <a href="{{ route('students.detail.admin', $user->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">Hapus</button>
                                </div>
                            </td>
                        </tr>    
                        @include('modal.delete-user')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data mahasiswa yang ditemukan</td>
                        </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    @include('modal.filter-student')
@endsection