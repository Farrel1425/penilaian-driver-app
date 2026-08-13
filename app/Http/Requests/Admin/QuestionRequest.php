<?php

namespace App\Http\Requests\Admin;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:1000'],
            'target_type' => ['required', Rule::in([Question::TARGET_DRIVER, Question::TARGET_VEHICLE])],
            'answer_type' => ['required', Rule::in([
                Question::TYPE_RATING,
                Question::TYPE_YES_NO,
                Question::TYPE_MULTIPLE_CHOICE,
                Question::TYPE_CHECKBOX,
                Question::TYPE_SHORT_TEXT,
                Question::TYPE_PARAGRAPH,
            ])],
            'is_required' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'status' => ['required', Rule::in([Question::STATUS_ACTIVE, Question::STATUS_INACTIVE])],
            'options' => ['nullable', 'array'],
            'options.*.option_text' => ['nullable', 'string', 'max:255'],
            'options.*.sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if (! in_array($this->input('answer_type'), [Question::TYPE_MULTIPLE_CHOICE, Question::TYPE_CHECKBOX], true)) {
                return;
            }

            if (count($this->normalizedOptions()) < 1) {
                $validator->errors()->add('options', 'Opsi jawaban wajib diisi untuk tipe pilihan.');
            }
        });
    }

    public function questionData(): array
    {
        return $this->safe()->only(['question', 'target_type', 'answer_type', 'is_required', 'sort_order', 'status']);
    }

    public function normalizedOptions(): array
    {
        return collect($this->input('options', []))
            ->map(fn (array $option, int $index): array => [
                'option_text' => trim((string) ($option['option_text'] ?? '')),
                'sort_order' => (int) ($option['sort_order'] ?? $index + 1),
            ])
            ->filter(fn (array $option): bool => $option['option_text'] !== '')
            ->values()
            ->all();
    }
}