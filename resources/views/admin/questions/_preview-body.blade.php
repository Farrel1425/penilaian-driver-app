@switch($answerType)
    @case(App\Models\Question::TYPE_RATING)
        <div class="rating-preview">@foreach ([1, 2, 3, 4, 5] as $value)<span>{{ $value }}</span>@endforeach</div>
        @break
    @case(App\Models\Question::TYPE_YES_NO)
        <div class="choice-preview"><label><input type="radio" disabled> Ya</label><label><input type="radio" disabled> Tidak</label></div>
        @break
    @case(App\Models\Question::TYPE_MULTIPLE_CHOICE)
        <div class="choice-preview">@forelse ($options as $option)<label><input type="radio" disabled> {{ $option }}</label>@empty<label><input type="radio" disabled> Opsi jawaban</label>@endforelse</div>
        @break
    @case(App\Models\Question::TYPE_CHECKBOX)
        <div class="choice-preview">@forelse ($options as $option)<label><input type="checkbox" disabled> {{ $option }}</label>@empty<label><input type="checkbox" disabled> Opsi jawaban</label>@endforelse</div>
        @break
    @case(App\Models\Question::TYPE_SHORT_TEXT)
        <input class="preview-input" type="text" placeholder="Jawaban singkat" disabled>
        @break
    @case(App\Models\Question::TYPE_PARAGRAPH)
        <textarea class="preview-input" rows="4" placeholder="Jawaban paragraf" disabled></textarea>
        @break
@endswitch