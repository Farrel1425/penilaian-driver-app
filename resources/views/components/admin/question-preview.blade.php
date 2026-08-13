@props(['question' => null, 'options' => collect()])

@php
    $text = old('question', $question?->question ?: 'Bagaimana keramahan driver?');
    $answerType = old('answer_type', $question?->answer_type ?: App\Models\Question::TYPE_RATING);
    $optionValues = collect(old('options', $options->map(fn ($option) => ['option_text' => $option->option_text, 'sort_order' => $option->sort_order])->all()))
        ->pluck('option_text')
        ->filter()
        ->values();
@endphp

<div class="question-preview" data-question-preview>
    <p class="eyebrow">Preview</p>
    <h3 data-preview-question>{{ $text }}</h3>
    <div data-preview-body>
        @include('admin.questions._preview-body', ['answerType' => $answerType, 'options' => $optionValues])
    </div>
</div>