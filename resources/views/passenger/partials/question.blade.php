@php($field = "answers[{$question->id}]")
<div class="passenger-question">
    <label class="question-title">{{ $question->question }} @if($question->is_required)<span>*</span>@endif</label>
    @error("answers.{$question->id}")<small class="passenger-error">{{ $message }}</small>@enderror
    @if($question->answer_type === App\Models\Question::TYPE_RATING)
        <div class="passenger-rating">@foreach([1,2,3,4,5] as $value)<label><input type="radio" name="{{ $field }}" value="{{ $value }}" @checked((string) old("answers.{$question->id}") === (string) $value)><span>{{ $value }}</span></label>@endforeach</div>
    @elseif($question->answer_type === App\Models\Question::TYPE_YES_NO)
        <div class="passenger-choice"><label><input type="radio" name="{{ $field }}" value="1" @checked(old("answers.{$question->id}") === '1')> Ya</label><label><input type="radio" name="{{ $field }}" value="0" @checked(old("answers.{$question->id}") === '0')> Tidak</label></div>
    @elseif($question->answer_type === App\Models\Question::TYPE_MULTIPLE_CHOICE)
        <div class="passenger-choice">@foreach($question->options as $option)<label><input type="radio" name="{{ $field }}" value="{{ $option->id }}" @checked((string) old("answers.{$question->id}") === (string) $option->id)> {{ $option->option_text }}</label>@endforeach</div>
    @elseif($question->answer_type === App\Models\Question::TYPE_CHECKBOX)
        <div class="passenger-choice">@foreach($question->options as $option)<label><input type="checkbox" name="{{ $field }}[]" value="{{ $option->id }}" @checked(in_array((string) $option->id, array_map('strval', old("answers.{$question->id}", [])), true))> {{ $option->option_text }}</label>@endforeach</div>
    @elseif($question->answer_type === App\Models\Question::TYPE_PARAGRAPH)
        <textarea name="{{ $field }}" rows="4" placeholder="Tulis jawaban Anda">{{ old("answers.{$question->id}") }}</textarea>
    @else
        <input type="text" name="{{ $field }}" value="{{ old("answers.{$question->id}") }}" placeholder="Tulis jawaban singkat">
    @endif
</div>