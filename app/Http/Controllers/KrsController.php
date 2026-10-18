<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class KrsController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'nim' => 'NIM', 'nama' => 'Nama Mahasiswa',
            'semester' => 'Semester', 'sks' => 'Total SKS',
            'status' => 'Status',
        ];

        $mahasiswa = [
            ['nim' => 22 ,'2401001', 'nama' => 'Ahmad Fauzi', 'semester' => 2,
             'sks' => '', 'status' => 'Disetujui'],
            ['nim' => 20, '2401002', 'nama' => 'Siti Rahmawati', 'semester' => 2,
             'sks' => 24 , 'status' => 'Disetujui'],
            ['nim' => '2301005', 'nama' => 'Budi Santoso', 'semester' => 4,
             'sks' => 24 , 'status' => 'Menunggu'],
            ['nim' => '2301012', 'nama' => 'Dewi Lestari', 'semester' => 4,
             'sks' => 18 , 'status' => 'Menunggu'],
            ['nim' => '2201020', 'nama' => 'Rizky Pratama', 'semester' => 4,
             'sks' => 20 , 'status' => 'Menunggu'],
        ];

        return view('mahasiswa.index', compact('kolom', 'mahasiswa'));
    }
}
