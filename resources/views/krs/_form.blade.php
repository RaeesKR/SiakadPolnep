<div class="mb-3">
    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
    <select name="mahasiswa_id" id="mahasiswa_id" @class(['form-control', 'is-invalid' => $errors->has('mahasiswa_id')]) required autofocus>
        <option value="">-- Pilih Mahasiswa dari Database --</option>
        @foreach($mahasiswas as $mhs)
            <option value="{{ $mhs->id }}" {{ old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
                {{ $mhs->nim }} - {{ $mhs->nama }}
            </option>
        @endforeach
    </select>
    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Tahun Akademik" name="tahun_akademik" :value="$krs->tahun_akademik" maxlength="20" required placeholder="Contoh: 2026/2027" />
</div>

<div class="mb-3">
    <x-form-input label="Semester" name="semester" :value="$krs->semester" maxlength="20" required placeholder="Contoh: Ganjil / Genap" />
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" @class(['form-control', 'is-invalid' => $errors->has('status')]) required>
        <option value="draft" {{ old('status', $krs->status) == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="Disetujui" {{ old('status', $krs->status) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
        <option value="Ditolak" {{ old('status', $krs->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Pilih Mata Kuliah yang Diambil:</label>
    <div class="border p-3 rounded bg-light">
        @foreach($mataKuliahs as $mk)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="mata_kuliah[]" value="{{ $mk->id }}" id="mk_{{ $mk->id }}"
                    {{ (is_array(old('mata_kuliah')) && in_array($mk->id, old('mata_kuliah'))) || (isset($krs) && $krs->mataKuliah->contains($mk->id)) ? 'checked' : '' }}>
                <label class="form-check-label" for="mk_{{ $mk->id }}">
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)
                </label>
            </div>
        @endforeach
    </div>
    @error('mata_kuliah')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>