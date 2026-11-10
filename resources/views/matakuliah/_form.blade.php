<div class="mb-3">
    <x-form-input label="Kode Mata Kuliah" name="kode_mk" :value="$matakuliah->kode_mk" 
    maxlength="20" required autofocus/>
</div>

<div class="mb-3">
    <x-form-input label="Nama Mata Kuliah" name="nama_mk" :value="$matakuliah->nama_mk" 
    maxlength="120" required/>
</div>

<div class="mb-3">
    <x-form-input label="SKS" name="sks" :value="$matakuliah->sks" type="number" min="1" max="10" step="1"
    maxlength="1" required/>
</div>