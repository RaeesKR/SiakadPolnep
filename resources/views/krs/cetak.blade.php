<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KRS {{ $krs->mahasiswa->nama }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; margin: 2px 0; }
        hr { margin: 10px 0; }
        .identitas td { padding: 2px 6px; border: none; }
        table.mk { width: 100%; border-collapse: collapse; margin-top: 12px; }
        table.mk th, table.mk td { border: 1px solid #333; padding: 6px; }
        table.mk th { background: #e9ecef; }
        .center { text-align: center; }
        .ttd { width: 100%; margin-top: 40px; }
        .ttd td { width: 50%; text-align: center; border: none; }
    </style>
</head>
<body>
    <h2>KARTU RENCANA STUDI (KRS)</h2>
    <h3>SISTEM INFORMASI AKADEMIK</h3>
    <hr>

    <table class="identitas">
        <tr><td>NIM</td><td>:</td><td>{{ $krs->mahasiswa->nim }}</td></tr>
        <tr><td>Nama</td><td>:</td><td>{{ $krs->mahasiswa->nama }}</td></tr>
        <tr><td>Program Studi</td><td>:</td><td>{{ $krs->mahasiswa->prodi }}</td></tr>
        <tr><td>Tahun Akademik</td><td>:</td><td>{{ $krs->tahun_akademik }}</td></tr>
        <tr><td>Semester</td><td>:</td><td>{{ $krs->semester }}</td></tr>
    </table>

    <table class="mk">
        <thead>
            <tr><th>No</th><th>Kode MK</th><th>Mata Kuliah</th><th>SKS</th></tr>
        </thead>
        <tbody>
            @foreach ($krs->details as $i => $d)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $d->matakuliah->kode_mk }}</td>
                <td>{{ $d->matakuliah->nama_mk }}</td>
                <td class="center">{{ $d->matakuliah->sks }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align:right"><strong>Total SKS</strong></td>
                <td class="center"><strong>{{ $totalSks }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table class="ttd">
        <tr>
            <td>Mahasiswa,<br><br><br><br>( {{ $krs->mahasiswa->nama }} )</td>
            <td>Dosen Wali,<br><br><br><br>( ............................ )</td>
        </tr>
    </table>
</body>
</html>