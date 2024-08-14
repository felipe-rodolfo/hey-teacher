<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $questions = Question::withSum('votes', 'like')->withSum('votes', 'unlike')->get();
        return view('dashboard', [
            'questions' => $questions
        ]);
    }
}
