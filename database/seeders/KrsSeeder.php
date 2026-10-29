<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = Mahasiswa::orderBy('id')
            ->limit(10)
            ->get();

        $mataKuliahIds = Matakuliah::inRandomOrder()
            ->limit(5)
            ->pluck('id');
        if ($mahasiswas->count() < 10) {
            throw new \RuntimeException(
                'Data mahasiswa harus minimal 10.'
            );
        }
        if ($mataKuliahIds->count() < 5) {
            throw new \RuntimeException(
                'Data mata kuliah harus minimal 5.'
            );
        }
        DB::transaction(function () use (
            $mahasiswas,
            $mataKuliahIds
        ) {
            foreach ($mahasiswas as $mahasiswa) {
                $krs = Krs::updateOrCreate(
                    [
                        'mahasiswa_id' => $mahasiswa->id,
                        'tahun_akademik' => '2026/2027',
                        'semester' => 'Ganjil',
                    ],
                    [
                        'status' => 'draft',
                    ]
                );
                $krs->mataKuliah()->sync($mataKuliahIds);
            }
        });
    }
}
