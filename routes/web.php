<?php

use App\Http\Controllers\{DashboardController, ProfileController, PublishQuestionController, QuestionController};
use App\Http\Controllers\Question\PublishController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Question
    Route::put('/question/publish/{question}', PublishController::class)->name('question.publish');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
