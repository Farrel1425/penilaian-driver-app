@csrf
<div class="form-section-title">Informasi Kendaraan</div>
<div class="form-grid">
    <x-admin.select label="Cabang" name="branch_id" required><option value="">Pilih cabang</option>@foreach($branches as $branch)<option value="{{ $branch->id }}" @selected((int) old('branch_id', $vehicle->branch_id) === $branch->id)>{{ $branch->name }}</option>@endforeach</x-admin.select>
    <x-admin.field label="Nomor Polisi" name="police_number" :value="$vehicle->police_number" required />
    <x-admin.field label="Merk" name="brand" :value="$vehicle->brand" required />
    <x-admin.field label="Model" name="model" :value="$vehicle->model" />
    <x-admin.field label="Tahun" name="year" type="number" :value="$vehicle->year" />
    <x-admin.field label="Warna" name="color" :value="$vehicle->color" />
    <x-admin.field label="Nomor Rangka" name="chassis_number" :value="$vehicle->chassis_number" />
    <x-admin.field label="Nomor Mesin" name="engine_number" :value="$vehicle->engine_number" />
    <x-admin.field label="Bahan Bakar" name="fuel_type" :value="$vehicle->fuel_type" />
    <x-admin.field label="Transmisi" name="transmission" :value="$vehicle->transmission" />
    <x-admin.field label="Kapasitas Penumpang" name="passenger_capacity" type="number" :value="$vehicle->passenger_capacity" />
    <x-admin.field label="Path Foto" name="photo" :value="$vehicle->photo" />
</div>
<div class="form-section-title">Informasi Operasional</div>
<div class="form-grid">
    <x-admin.select label="Status" name="status" required>@foreach([App\Models\Vehicle::STATUS_ACTIVE => 'Aktif', App\Models\Vehicle::STATUS_INACTIVE => 'Nonaktif'] as $value => $label)<option value="{{ $value }}" @selected(old('status', $vehicle->status ?? App\Models\Vehicle::STATUS_ACTIVE) === $value)>{{ $label }}</option>@endforeach</x-admin.select>
    <x-admin.field label="Tanggal Perolehan" name="acquisition_date" type="date" :value="optional($vehicle->acquisition_date)->format('Y-m-d')" />
    <x-admin.field label="Sumber Pengadaan" name="acquisition_source" :value="$vehicle->acquisition_source" />
    <x-admin.field label="Jenis Kepemilikan" name="ownership_type" :value="$vehicle->ownership_type" />
    <x-admin.field label="Nomor Kontrak" name="contract_number" :value="$vehicle->contract_number" />
    <x-admin.field label="Masa Berlaku Kontrak" name="contract_expired_at" type="date" :value="optional($vehicle->contract_expired_at)->format('Y-m-d')" />
    <x-admin.textarea label="Keterangan" name="description" :value="$vehicle->description" />
</div>
<div class="form-actions"><a class="secondary-button" href="{{ route('admin.vehicles.index') }}">Batal</a><button class="primary-button" type="submit">Simpan</button></div>