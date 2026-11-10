@extends('exports.layout_pdf')
@section('judul', 'Data Mahasiswa')
@section('isi')
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Angkatan</th>
            <th>Program Studi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $m)
        <tr>
            <td class="center">{{ $i + 1 }}</td>
            <td>{{ $m->nim }}</td>
            <td>{{ $m->nama }}</td>
            <td class="center">{{ $m->jenis_kelamin }}</td>
            <td>{{ $m->email }}</td>
            <td class="center">{{ $m->angkatan }}</td>
            <td>{{ $m->program_studi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection