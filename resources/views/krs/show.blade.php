@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <x-page-header judul="Detail KRS" deskripsi="Informasi lengkap Kartu Rencana Studi dan mata kuliah yang diambil." />

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">Informasi KRS</div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">NIM</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa->nim ?? '-' }}</dd>

                <dt class="col-sm-3">Nama Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa->nama ?? '-' }}</dd>

                <dt class="col-sm-3">Tahun Akademik</dt>
                <dd class="col-sm-9">{{ $krs->tahun_akademik }}</dd>

                <dt class="col-sm-3">Semester</dt>
                <dd class="col-sm-9">{{ $krs->semester }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><span class="badge bg-secondary">{{ ucfirst($krs->status) }}</span></dd>
            </dl>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-body fw-semibold">Daftar Mata Kuliah yang Diambil</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada mata kuliah yang dipilih pada KRS ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('krs.edit', $krs) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Ubah
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection