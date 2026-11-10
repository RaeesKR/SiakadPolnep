@extends('exports.layout_pdf')
@section('judul', 'Data KRS Mahasiswa')
@section('isi')
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tahun Akademik</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Mata Kuliah</th>
            <th>Total SKS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $krs)
        <tr>
            <td class="center">{{ $i + 1 }}</td>
            <td>{{ $krs->mahasiswa->nim ?? '-' }}</td>
            <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
            <td class="center">{{ $krs->tahun_akademik }}</td>
            <td class="center">{{ $krs->semester }}</td>
            <td class="center">{{ $krs->status }}</td>
            <td>
                @forelse ($krs->mataKuliah as $mk)
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)<br>
                @empty
                    -
                @endforelse
            </td>
            <td class="center">{{ $krs->mataKuliah->sum('sks') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection