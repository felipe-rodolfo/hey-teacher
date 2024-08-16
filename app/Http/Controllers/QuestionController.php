<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
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

        return to_route('dashboard');
    }
}
