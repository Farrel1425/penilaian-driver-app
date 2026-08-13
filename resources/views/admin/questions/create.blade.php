<x-layouts.admin title="Tambah Pertanyaan">
    <x-admin.page-header title="Tambah Pertanyaan" description="Buat konfigurasi pertanyaan baru."><a class="secondary-button" href="{{ route('admin.questions.index') }}">Kembali</a></x-admin.page-header>
    <x-admin.panel title="Konfigurasi Pertanyaan"><form method="POST" action="{{ route('admin.questions.store') }}">@include('admin.questions._form')</form></x-admin.panel>
</x-layouts.admin>