<?php

namespace App\Http\Controllers;

use App\Exports\KrsExport;
use App\Exports\MahasiswaExport;
use App\Exports\MataKuliahExport;
use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    // ===== EXCEL =====
    public function mahasiswaExcel()
    {
        return Excel::download(new MahasiswaExport, 'data-mahasiswa.xlsx');
    }

    public function matakuliahExcel()
    {
        return Excel::download(new MataKuliahExport, 'data-matakuliah.xlsx');
    }

    public function krsExcel()
    {
        return Excel::download(new KrsExport, 'data-krs.xlsx');
    }

    public function dosenExcel()
    {
        return Excel::download(new DosenExport, 'data-dosen.xlsx');
    }

    // ===== PDF =====
    public function mahasiswaPdf()
    {
        $data = Mahasiswa::orderBy('nim')->get();

        return Pdf::loadView('exports.mahasiswa_pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->download('data-mahasiswa.pdf');
    }

    public function matakuliahPdf()
    {
        $data = MataKuliah::orderBy('kode_mk')->get();

        return Pdf::loadView('exports.matakuliah_pdf', compact('data'))
            ->setPaper('a4', 'portrait')
            ->download('data-matakuliah.pdf');
    }

    public function krsPdf()
    {
        $data = Krs::with(['mahasiswa', 'mataKuliah'])
            ->orderBy('tahun_akademik')
            ->orderBy('semester')
            ->get();

        return Pdf::loadView('exports.krs_pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->download('data-krs.pdf');
    }

    public function dosenPdf()
    {
        $data = Dosen::orderBy('nama')->get();

        return Pdf::loadView('exports.dosen_pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->download('data-dosen.pdf');
    }
}