<x-layouts.admin title="Detail Pertanyaan">
    <x-admin.page-header title="Detail Pertanyaan" description="Konfigurasi, opsi, dan preview pertanyaan."><a class="secondary-button" href="{{ route('admin.questions.index') }}">Kembali</a></x-admin.page-header>
    <x-admin.flash />
    <div class="detail-layout">
        <x-admin.panel title="Informasi Pertanyaan">
            <div class="detail-grid">
                <x-admin.detail-row label="Pertanyaan" :value="$question->question" />
                <x-admin.detail-row label="Target" :value="$question->target_type === 'driver' ? 'Driver' : 'Kendaraan'" />
                <x-admin.detail-row label="Tipe Jawaban" :value="str($question->answer_type)->replace('_', ' ')->title()" />
                <x-admin.detail-row label="Wajib" :value="$question->is_required ? 'Wajib' : 'Opsional'" />
                <x-admin.detail-row label="Urutan" :value="$question->sort_order" />
                <x-admin.detail-row label="Status" :value="$question->status === 'active' ? 'Aktif' : 'Nonaktif'" />
            </div>
            @if($question->options->isNotEmpty())
                <div class="option-readonly-list">
                    <div class="form-section-title">Opsi Jawaban</div>
                    @foreach($question->options as $option)<div><span>{{ $option->sort_order }}</span><strong>{{ $option->option_text }}</strong></div>@endforeach
                </div>
            @endif
        </x-admin.panel>

        <x-admin.panel title="Preview & Aksi">
            <x-admin.question-preview :question="$question" :options="$question->options" />
            <div class="summary-grid"><div><strong>{{ $question->rating_answers_count }}</strong><span>Jawaban Tersimpan</span></div></div>
            <div class="form-actions stack-actions"><a class="primary-button" href="{{ route('admin.questions.edit', $question) }}">Edit</a><form method="POST" action="{{ route('admin.questions.toggle-status', $question) }}">@csrf @method('PATCH')<button class="secondary-button" type="submit">{{ $question->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}</button></form><form method="POST" action="{{ route('admin.questions.destroy', $question) }}">@csrf @method('DELETE')<button class="danger-button" type="submit">Hapus</button></form></div>
        </x-admin.panel>
    </div>
</x-layouts.admin>