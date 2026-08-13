<x-layouts.admin title="Edit Pertanyaan">
    <x-admin.page-header title="Edit Pertanyaan" description="Perbarui konfigurasi dan opsi pertanyaan."><a class="secondary-button" href="{{ route('admin.questions.show', $question) }}">Kembali</a></x-admin.page-header>
    <x-admin.panel title="Konfigurasi Pertanyaan"><form method="POST" action="{{ route('admin.questions.update', $question) }}">@method('PUT') @include('admin.questions._form')</form></x-admin.panel>
</x-layouts.admin>