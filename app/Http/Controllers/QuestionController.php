<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => Auth()->user()->questions,
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
            ],
        ]);

        Auth()->user()->questions()->create([
            'question' => request()->question,
            'draft' => true
        ]);

        return redirect()->back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);
        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {
        $question->question = request()->question;
        $question->save();
        return back();
    }
}
