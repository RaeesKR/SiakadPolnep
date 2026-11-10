<div class="mb-3">
    <x-form-input label="NIM" name="nim" :value="$mahasiswa->nim" 
    maxlength="20" required autofocus/>
</div>

<div class="mb-3">
    <x-form-input label="Nama Mahasiswa" name="nama" :value="$mahasiswa->nama" 
    maxlength="120" required/>
</div>

<div class="mb-3">
    <x-form-input label="Jenis Kelamin (L/P)" name="jenis_kelamin" :value="$mahasiswa->jenis_kelamin" 
    maxlength="1" required/>
</div>

<div class="mb-3">
    <x-form-input label="Email" name="email" type="email" :value="$mahasiswa->email" 
    maxlength="120" required/>
</div>

<div class="mb-3">
    <x-form-input label="Angkatan" name="angkatan" type="number" :value="$mahasiswa->angkatan" 
    maxlength="20" required/>
</div>

<div class="mb-3">
    <x-form-input label="Program Studi" name="program_studi" :value="$mahasiswa->program_studi"
    maxlength="100" required/>
</div>
