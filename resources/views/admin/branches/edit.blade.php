<x-layouts.admin title="Edit Cabang">
    <x-admin.page-header title="Edit Cabang" description="Perbarui data cabang."><a class="secondary-button" href="{{ route('admin.branches.show', $branch) }}">Kembali</a></x-admin.page-header>
    <x-admin.panel title="Informasi Cabang"><form method="POST" action="{{ route('admin.branches.update', $branch) }}">@method('PUT') @include('admin.branches._form')</form></x-admin.panel>
</x-layouts.admin>