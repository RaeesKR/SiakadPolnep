<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index(): View
    {
        return view('krs.index');
    }

    public function data(): JsonResponse
    {
        $query = Krs::query()->with('mahasiswa')->select(['id', 'mahasiswa_id', 'tahun_akademik', 'semester', 'status']);
        
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('nim_mahasiswa', function (Krs $krs) {
                return $krs->mahasiswa ? $krs->mahasiswa->nim : '-';
            })
            ->addColumn('nama_mahasiswa', function (Krs $krs) {
                return $krs->mahasiswa ? $krs->mahasiswa->nama : '-';
            })
            ->addColumn('aksi', function (Krs $krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();
        return view('krs.create', [
            'krs' => new Krs(),
            'mahasiswas' => $mahasiswas,
            'mataKuliahs' => $mataKuliahs,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        $krs = Krs::create([
            'mahasiswa_id' => $validated['mahasiswa_id'],
            'tahun_akademik' => $validated['tahun_akademik'],
            'semester' => $validated['semester'],
            'status' => $validated['status'],
        ]);

        // Menyimpan detail mata kuliah yang dipilih (jika ada)
        if (isset($validated['mata_kuliah'])) {
            $krs->mataKuliah()->sync($validated['mata_kuliah']);
        }

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function show(Krs $krs): View
    {
        $krs->load(['mahasiswa', 'mataKuliah']);
        return view('krs.show', compact('krs'));
    }

    public function edit(Krs $krs): View
    {
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();
        $krs->load('mataKuliah');
        return view('krs.edit', compact('krs', 'mahasiswas', 'mataKuliahs'));
    }

    public function update(Request $request, Krs $krs): RedirectResponse
    {
        $validated = $this->validatedData($request, $krs);

        $krs->update([
            'mahasiswa_id' => $validated['mahasiswa_id'],
            'tahun_akademik' => $validated['tahun_akademik'],
            'semester' => $validated['semester'],
            'status' => $validated['status'],
        ]);

        // Memperbarui pilihan mata kuliah
        if (isset($validated['mata_kuliah'])) {
            $krs->mataKuliah()->sync($validated['mata_kuliah']);
        } else {
            $krs->mataKuliah()->detach();
        }

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $krs): JsonResponse
    {
        try {
            // Mencegah masalah integritas referensial dengan menghapus relasi detail lebih dulu
            $krs->mataKuliah()->detach();
            $krs->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus: masih dipakai di data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.',
        ]);
    }

    private function validatedData(Request $request, ?Krs $krs = null): array
    {
        return $request->validate([
            'mahasiswa_id' => [
            'required', 
            'exists:mahasiswa,id',
            Rule::unique('krs')->where(function ($query) use ($request) {
                return $query->where('tahun_akademik', $request->tahun_akademik)
                             ->where('semester', $request->semester);
            })->ignore($krs?->id),
        ],
            'tahun_akademik' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:20'],
            'status' => ['required', 'string', 'in:draft,Disetujui,Ditolak'],
            'mata_kuliah' => ['array'],
            'mata_kuliah.*' => ['exists:mata_kuliah,id'],
        ], [
            'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists' => 'Mahasiswa yang dipilih tidak valid.',
            'mahasiswa_id.unique' => 'KRS untuk mahasiswa ini pada tahun akademik dan semester yang sama sudah ada.',
            'tahun_akademik.required' => 'Tahun Akademik wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);
    }

    // Tambahan metode untuk fitur cetak KRS
    public function cetak(Krs $krs): View
    {
        $krs->load(['mahasiswa', 'mataKuliah']);
        return view('krs.cetak', compact('krs'));
    }
}