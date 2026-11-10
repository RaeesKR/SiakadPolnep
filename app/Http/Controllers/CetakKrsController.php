<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakKrsController extends Controller
{
    public function cetak($id)
    {
        $krs = Krs::with(['mahasiswa', 'details.matakuliah'])->findOrFail($id);

        $totalSks = $krs->details->sum(fn ($d) => $d->matakuliah->sks);

        $pdf = Pdf::loadView('krs.cetak', compact('krs', 'totalSks'))
            ->setPaper('a4', 'portrait');

        // stream() = tampil di browser (cocok untuk demo), download() = langsung unduh
        return $pdf->stream('KRS-' . $krs->mahasiswa->nim . '.pdf');
    }
}