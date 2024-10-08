<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\SameQuestion;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => Auth()->user()->questions,
            'archivedQuestions' => Auth()->user()->questions()->onlyTrashed()->get()
        ]);
    }
    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail("Are you sure that is a question? It is missing question mark in the end");
                    }
                },
                new SameQuestion()
            ],
        ]);

        Auth()->user()->questions()->create([
            'question' => request()->question,
            'draft' => true
        ]);

        return redirect()->back();
    }

    public function archive(Question $question): RedirectResponse
    {
        $this->authorize('archive', $question);

        $question->delete();

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->forceDelete();

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);
        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {
        $this->authorize('update', $question);
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail("Are you sure that is a question? It is missing question mark in the end");
                    }
                },
            ],
        ]);

        $question->question = request()->question;
        $question->save();
        return to_route('question.index');
    }

    public function restore(int $id): RedirectResponse
    {
        $question = Question::withTrashed()->find($id);
        $question->restore();
        return back();
    }
}
