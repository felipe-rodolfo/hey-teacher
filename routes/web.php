<?php

use App\Http\Controllers\{DashboardController, Question, ProfileController};
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    // Question
    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::patch('/question/{question}', [QuestionController::class, 'archive'])->name('question.archive');
    Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::patch('/question/{question}/restore', [QuestionController::class, 'restore'])->name('question.restore');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
    Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
