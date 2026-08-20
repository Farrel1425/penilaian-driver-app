@php($editing = $user->exists)
<form method="POST" action="{{ $editing ? route('admin.users.update', $user) : route('admin.users.store') }}" enctype="multipart/form-data" class="user-form-card">
    @csrf
    @if ($editing) @method('PUT') @endif
    <div class="user-form-heading"><h2>{{ $editing ? 'Informasi Admin' : 'Buat Akun Admin' }}</h2><p>Admin aktif memiliki akses penuh ke seluruh fitur LAIS.</p></div>
    <div class="user-photo-field"><span class="user-photo user-photo-large">@if ($editing && $user->photo)<img src="{{ str_starts_with($user->photo, 'http') ? $user->photo : asset('storage/'.$user->photo) }}" alt="Foto {{ $user->name }}">@else<x-lucide-user aria-hidden="true" />@endif</span><div><label for="photo">Foto profil</label><input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp"><p>JPG, PNG, atau WEBP. Maksimal 2 MB.</p>@error('photo')<span class="form-error">{{ $message }}</span>@enderror</div></div>
    <div class="user-form-grid">
        <div class="form-group"><label for="name">Nama lengkap</label><input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name">@error('name')<span class="form-error">{{ $message }}</span>@enderror</div>
        <div class="form-group"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email">@error('email')<span class="form-error">{{ $message }}</span>@enderror</div>
        <div class="form-group"><label>Role</label><div class="user-role-readonly"><x-lucide-shield-check aria-hidden="true" /> Admin - akses penuh</div></div>
        <div class="form-group"><label for="status">Status akun</label><select id="status" name="status" required><option value="active" @selected(old('status', $user->status ?: 'active') === 'active')>Aktif</option><option value="inactive" @selected(old('status', $user->status) === 'inactive')>Nonaktif</option></select>@error('status')<span class="form-error">{{ $message }}</span>@enderror</div>
        <div class="form-group"><label for="password">Kata sandi {{ $editing ? '(opsional)' : '' }}</label><input id="password" name="password" type="password" {{ $editing ? '' : 'required' }} autocomplete="new-password">@error('password')<span class="form-error">{{ $message }}</span>@enderror</div>
        <div class="form-group"><label for="password_confirmation">Konfirmasi kata sandi {{ $editing ? '(opsional)' : '' }}</label><input id="password_confirmation" name="password_confirmation" type="password" {{ $editing ? '' : 'required' }} autocomplete="new-password"></div>
    </div>
    <div class="user-form-actions"><a href="{{ $editing ? route('admin.users.show', $user) : route('admin.users.index') }}" class="admin-secondary-button">Batal</a><button type="submit" class="admin-primary-button">{{ $editing ? 'Simpan Perubahan' : 'Simpan Admin' }}</button></div>
</form>
