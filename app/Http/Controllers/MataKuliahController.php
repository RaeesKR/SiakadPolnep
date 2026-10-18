<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'kode' => 'Kode', 'nama' => 'Mata Kuliah',
            'sks' => 'SKS', 'semester' => 'Semester', 'jenis' => 'Jenis',
        ];

        $matakuliah = [
            ['kode' => 'TIF201', 'nama' => 'Basis Data',
            'sks' => '3', 'semester' => '2', 'jenis' => 'Praktik',
            ],
            ['kode' => 'TIF202', 'nama' => 'Jaringan Komputer',
            'sks' => '3', 'semester' => '2', 'jenis' => 'Praktik',
            ],
            ['kode' => 'TIF203', 'nama' => 'Matematika',
            'sks' => '3', 'semester' => '2', 'jenis' => 'Teori',
            ],
            ['kode' => 'TIF204', 'nama' => 'Rekayasa Perangkat Lunak',
            'sks' => '3', 'semester' => '2', 'jenis' => 'Teori',
            ],
            ['kode' => 'TIF205', 'nama' => 'Desain Grafis',
            'sks' => '3', 'semester' => '2', 'jenis' => 'Praktik',
            ],
            
        ];

        return view('matakuliah.index', compact('kolom', 'matakuliah'));
    }
}
