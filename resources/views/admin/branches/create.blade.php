<x-layouts.admin title="Tambah Cabang">
    <x-admin.page-header title="Tambah Cabang" description="Buat cabang atau unit kerja baru."><a class="secondary-button" href="{{ route('admin.branches.index') }}">Kembali</a></x-admin.page-header>
    <x-admin.panel title="Informasi Cabang"><form method="POST" action="{{ route('admin.branches.store') }}">@include('admin.branches._form')</form></x-admin.panel>
</x-layouts.admin>