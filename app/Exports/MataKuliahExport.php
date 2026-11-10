<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MataKuliahExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return MataKuliah::orderBy('kode_mk')->get();
    }

    public function headings(): array
    {
        return ['No', 'Kode MK', 'Nama Mata Kuliah', 'SKS'];
    }

    public function map($mk): array
    {
        return [++$this->no, $mk->kode_mk, $mk->nama_mk, $mk->sks];
    }
}