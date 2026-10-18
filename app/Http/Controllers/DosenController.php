<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'nidn' => 'NIDN', 'nama' => 'Nama Dosen',
            'keahlian' => 'bidang Keahlian', 'status' => 'Status',
        ];

        $dosen = [
            ['nidn' => '002401001', 'nama' => 'Joko Wirawan', 'keahlian' => 'Basis Data',
             'status' => 'Aktif'],
            ['nidn' => '002401002', 'nama' => 'Prabudi Subanu', 'keahlian' => 'Jaringan dan Komputer',
             'status' => 'Aktif'],
            ['nidn' => '002301005', 'nama' => 'Mega Waskita', 'keahlian' => 'Matematika',
             'status' => 'Aktif'],
            ['nidn' => '002301012', 'nama' => 'Puan Putri Utama', 'keahlian' => 'Rekayasa Perangkat Lunak',
             'status' => 'Cuti'],
            ['nidn' => '002201020', 'nama' => 'Gibran Raja Prakasa', 'keahlian' => 'Desain Grafis',
             'status' => 'Lulus'],
        ];

        return view('dosen.index', compact('kolom', 'dosen'));
    }
}
