<?php

namespace App\Exports;

use App\Models\Krs;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KrsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection(): Collection
    {
        $rows = collect();
        $no = 0;

        $daftarKrs = Krs::with(['mahasiswa', 'mataKuliah'])
            ->orderBy('tahun_akademik')
            ->orderBy('semester')
            ->get();

        foreach ($daftarKrs as $krs) {
            $dasar = [
                $krs->mahasiswa->nim ?? '-',
                $krs->mahasiswa->nama ?? '-',
                $krs->tahun_akademik,
                $krs->semester,
                $krs->status,
            ];

            if ($krs->mataKuliah->isEmpty()) {
                $rows->push(array_merge([++$no], $dasar, ['-', '-', 0]));
                continue;
            }

            foreach ($krs->mataKuliah as $mk) {
                $rows->push(array_merge([++$no], $dasar, [$mk->kode_mk, $mk->nama_mk, $mk->sks]));
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['No', 'NIM', 'Nama Mahasiswa', 'Tahun Akademik', 'Semester',
                'Status', 'Kode MK', 'Mata Kuliah', 'SKS'];
    }
}