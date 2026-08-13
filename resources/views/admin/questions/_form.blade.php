@csrf
@php
    $optionRows = collect(old('options', $question->exists ? $question->options->map(fn ($option) => ['option_text' => $option->option_text, 'sort_order' => $option->sort_order])->all() : [
        ['option_text' => '', 'sort_order' => 1],
        ['option_text' => '', 'sort_order' => 2],
    ]))->values();
@endphp

<div class="question-form-layout">
    <div>
        <div class="form-section-title">Informasi Pertanyaan</div>
        <div class="form-grid">
            <x-admin.textarea label="Pertanyaan" name="question" :value="$question->question" required data-question-input />
            <x-admin.select label="Target" name="target_type" required>
                <option value="{{ App\Models\Question::TARGET_DRIVER }}" @selected(old('target_type', $question->target_type ?? App\Models\Question::TARGET_DRIVER) === App\Models\Question::TARGET_DRIVER)>Driver</option>
                <option value="{{ App\Models\Question::TARGET_VEHICLE }}" @selected(old('target_type', $question->target_type) === App\Models\Question::TARGET_VEHICLE)>Kendaraan</option>
            </x-admin.select>
            <x-admin.select label="Tipe Jawaban" name="answer_type" required data-answer-type>
                @foreach ([
                    App\Models\Question::TYPE_RATING => 'Rating 1-5',
                    App\Models\Question::TYPE_YES_NO => 'Ya/Tidak',
                    App\Models\Question::TYPE_MULTIPLE_CHOICE => 'Pilihan Ganda',
                    App\Models\Question::TYPE_CHECKBOX => 'Checkbox',
                    App\Models\Question::TYPE_SHORT_TEXT => 'Jawaban Singkat',
                    App\Models\Question::TYPE_PARAGRAPH => 'Paragraf',
                ] as $value => $label)
                    <option value="{{ $value }}" @selected(old('answer_type', $question->answer_type ?? App\Models\Question::TYPE_RATING) === $value)>{{ $label }}</option>
                @endforeach
            </x-admin.select>
            <x-admin.select label="Wajib" name="is_required" required>
                <option value="1" @selected((string) old('is_required', (int) ($question->is_required ?? true)) === '1')>Wajib</option>
                <option value="0" @selected((string) old('is_required', (int) ($question->is_required ?? true)) === '0')>Tidak Wajib</option>
            </x-admin.select>
            <x-admin.field label="Urutan" name="sort_order" type="number" :value="$question->sort_order ?? 0" required />
            <x-admin.select label="Status" name="status" required>
                <option value="{{ App\Models\Question::STATUS_ACTIVE }}" @selected(old('status', $question->status ?? App\Models\Question::STATUS_ACTIVE) === App\Models\Question::STATUS_ACTIVE)>Aktif</option>
                <option value="{{ App\Models\Question::STATUS_INACTIVE }}" @selected(old('status', $question->status) === App\Models\Question::STATUS_INACTIVE)>Nonaktif</option>
            </x-admin.select>
        </div>

        <div class="option-builder" data-option-builder>
            <div class="form-section-title">Opsi Jawaban</div>
            <p class="form-help">Digunakan hanya untuk Pilihan Ganda dan Checkbox.</p>
            @error('options')<small class="form-error">{{ $message }}</small>@enderror
            <div class="option-list" data-option-list>
                @foreach ($optionRows as $index => $option)
                    <div class="option-row" data-option-row>
                        <input type="text" name="options[{{ $index }}][option_text]" value="{{ $option['option_text'] ?? '' }}" placeholder="Opsi jawaban" data-option-text>
                        <input type="number" name="options[{{ $index }}][sort_order]" value="{{ $option['sort_order'] ?? $index + 1 }}" min="0" aria-label="Urutan opsi">
                        <button class="icon-inline-button" type="button" data-remove-option aria-label="Hapus opsi">×</button>
                    </div>
                @endforeach
            </div>
            <button class="secondary-button" type="button" data-add-option>Tambah Opsi</button>
        </div>

        <div class="form-actions">
            <a class="secondary-button" href="{{ route('admin.questions.index') }}">Batal</a>
            <button class="primary-button" type="submit">Simpan</button>
        </div>
    </div>

    <x-admin.question-preview :question="$question" :options="$question->exists ? $question->options : collect()" />
</div>