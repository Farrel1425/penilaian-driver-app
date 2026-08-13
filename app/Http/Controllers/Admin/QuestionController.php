<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(Request $request): View
    {
        $questions = Question::query()
            ->withCount('options')
            ->when($request->string('search')->toString(), fn ($query, string $search) => $query->where('question', 'like', "%{$search}%"))
            ->when($request->string('target_type')->toString(), fn ($query, string $target) => $query->where('target_type', $target))
            ->when($request->string('answer_type')->toString(), fn ($query, string $type) => $query->where('answer_type', $type))
            ->when($request->string('status')->toString(), fn ($query, string $status) => $query->where('status', $status))
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        return view('admin.questions.index', ['questions' => $questions]);
    }

    public function create(): View
    {
        return view('admin.questions.create', ['question' => new Question()]);
    }

    public function store(QuestionRequest $request): RedirectResponse
    {
        $question = DB::transaction(function () use ($request): Question {
            $question = Question::query()->create($request->questionData());
            $this->syncOptions($question, $request->normalizedOptions());

            return $question;
        });

        return redirect()->route('admin.questions.show', $question)->with('status', 'Pertanyaan berhasil dibuat.');
    }

    public function show(Question $question): View
    {
        $question->load('options')->loadCount('ratingAnswers');

        return view('admin.questions.show', compact('question'));
    }

    public function edit(Question $question): View
    {
        $question->load('options');

        return view('admin.questions.edit', compact('question'));
    }

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        DB::transaction(function () use ($request, $question): void {
            $question->update($request->questionData());
            $this->syncOptions($question, $request->normalizedOptions());
        });

        return redirect()->route('admin.questions.show', $question)->with('status', 'Pertanyaan berhasil diperbarui.');
    }

    public function toggleStatus(Question $question): RedirectResponse
    {
        $question->update(['status' => $question->status === Question::STATUS_ACTIVE ? Question::STATUS_INACTIVE : Question::STATUS_ACTIVE]);

        return back()->with('status', 'Status pertanyaan berhasil diperbarui.');
    }

    public function destroy(Question $question): RedirectResponse
    {
        if ($question->ratingAnswers()->exists()) {
            $question->update(['status' => Question::STATUS_INACTIVE]);

            return back()->with('status', 'Pertanyaan sudah dipakai pada rating, jadi dinonaktifkan.');
        }

        $question->delete();

        return redirect()->route('admin.questions.index')->with('status', 'Pertanyaan berhasil dihapus.');
    }

    private function syncOptions(Question $question, array $options): void
    {
        $question->options()->delete();

        if (! in_array($question->answer_type, [Question::TYPE_MULTIPLE_CHOICE, Question::TYPE_CHECKBOX], true)) {
            return;
        }

        foreach ($options as $index => $option) {
            $question->options()->create([
                'option_text' => $option['option_text'],
                'sort_order' => $option['sort_order'] ?: $index + 1,
            ]);
        }
    }
}