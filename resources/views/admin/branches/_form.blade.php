@csrf
<div class="form-grid">
    <x-admin.field label="Kode Cabang" name="code" :value="$branch->code" required />
    <x-admin.field label="Nama Cabang" name="name" :value="$branch->name" required />
    <x-admin.select label="Status" name="status" :value="$branch->status ?? App\Models\Branch::STATUS_ACTIVE" required>
        @foreach ([App\Models\Branch::STATUS_ACTIVE => 'Aktif', App\Models\Branch::STATUS_INACTIVE => 'Nonaktif'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $branch->status ?? App\Models\Branch::STATUS_ACTIVE) === $value)>{{ $label }}</option>
        @endforeach
    </x-admin.select>
    <x-admin.textarea label="Alamat" name="address" :value="$branch->address" />
</div>
<div class="form-actions">
    <a class="secondary-button" href="{{ route('admin.branches.index') }}">Batal</a>
    <button class="primary-button" type="submit">Simpan</button>
</div>