<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all the question', function () {
    $user = User::factory()->create();
    $questions = Question::factory()->count(5)->create();
    actingAs($user);

    $response = get(route('dashboard'));

    foreach ($questions as $question) {
        $response->assertSee($question->question);
    }
});

it('should paginate the result', function () {
    $user = User::factory()->create();
    Question::factory()->count(20)->create();
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn($value) => $value instanceof LengthAwarePaginator);
});
