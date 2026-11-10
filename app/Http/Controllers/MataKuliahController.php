<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        $query = MataKuliah::query()->select(['id', 'kode_mk', 'nama_mk', 'sks',]);
        
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $matakuliah) {
                return view('matakuliah._aksi', compact('matakuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', ['matakuliah' => new MataKuliah()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $matakuliah = MataKuliah::create($this->validate($request));
        return redirect()->route('matakuliah.index')->with('success','Data Mata Kuliah' . $matakuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $matakuliah): View
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah): RedirectResponse
    {
        $matakuliah->update($this->validate($request, $matakuliah));
        return redirect()
        ->route('matakuliah.index')
        ->with('success','Data mata kuliah ' . $matakuliah->nama_mk . ' berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah): JsonResponse
    {
        try {
            $matakuliah->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data mata kuliah tidak dapat dihapus: masih dipakai di data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data mata kuliah ' . $matakuliah->nama_mk . ' berhasil dihapus.',
        ]);
    }

    private function validate(Request $request, ?MataKuliah $matakuliah = null): array
    {
        return $request->validate([
            'kode_mk' => ['required', 'string', 'max:20', 
                Rule::unique(MataKuliah::class, 'kode_mk')->ignore($matakuliah?->id)],
            'nama_mk' => ['required', 'string', 'max:120'],
            'sks' => ['required', 'integer', 'min:1'],
        ], [
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.max' => 'Kode Mata Kuliah maksimal 20 karakter',
            'kode_mk.unique' => 'Kode Mata Kuliah sudah dipakai.',
            'nama_mk.required' => 'Nama Mata Kuliah wajib diisi.',
            'nama_mk.max' => 'Nama Mata Kuliah maksimal 120 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
        ]);
    }
}
