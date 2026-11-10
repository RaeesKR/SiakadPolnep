@extends('exports.layout_pdf')
@section('judul', 'Data Mata Kuliah')
@section('isi')
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $mk)
        <tr>
            <td class="center">{{ $i + 1 }}</td>
            <td>{{ $mk->kode_mk }}</td>
            <td>{{ $mk->nama_mk }}</td>
            <td class="center">{{ $mk->sks }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection