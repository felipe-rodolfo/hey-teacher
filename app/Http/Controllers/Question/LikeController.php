<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{Question};
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        Auth::user()->like($question);

        return back();
    }
}
