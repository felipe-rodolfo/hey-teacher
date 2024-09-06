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

it('should order by like and unlike, most liked question should be at the top, most unliked questions should be in the bottom', function () {
    $user       = User::factory()->create();
    $secondUser = User::factory()->create();
    Question::factory()->count(5)->create();

    $mostLikedQuestion = Question::find(3);
    $user->like($mostLikedQuestion);

    $mostUnlikedQuestion = Question::find(1);
    $secondUser->unlike($mostUnlikedQuestion);

    actingAs($user);
    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) {

            expect($questions)
                ->first()->id->toBe(3)
                ->and($questions)
                ->last()->id->toBe(1);

            return true;
        });
});
