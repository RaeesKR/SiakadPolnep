@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap data mahasiswa." />

<div class="card border-0 shadow-sm col-md-6">
    <div class="card-body">
        <p><strong>NIM:</strong> {{ $mahasiswa['nim'] }}</p>
        <p><strong>Nama Lengkap:</strong> {{ $mahasiswa['nama'] }}</p>
        <p><strong>Angkatan:</strong> {{ $mahasiswa['angkatan'] }}</p>
        <p><strong>Email:</strong> {{ $mahasiswa['email'] }}</p>
        <p><strong>Status:</strong> {{ $mahasiswa['status'] }}</p>
        
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>
@endsection