<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private int $no = 0;

    public function collection(): Collection
    {
        return Mahasiswa::orderBy('nim')->get();
    }

    public function headings(): array
    {
        return ['No', 'NIM', 'Nama', 'Jenis Kelamin', 'Email', 'Angkatan', 'Program Studi'];
    }

    public function map($mhs): array
    {
        return [
            ++$this->no,
            $mhs->nim,
            $mhs->nama,
            $mhs->jenis_kelamin,
            $mhs->email,
            $mhs->angkatan,
            $mhs->program_studi,
        ];
    }
}