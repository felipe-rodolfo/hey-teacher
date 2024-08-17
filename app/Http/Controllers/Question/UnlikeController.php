<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{RedirectResponse, Request};

class UnlikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        Auth::user()->unlike($question);

        return back();
    }
}
