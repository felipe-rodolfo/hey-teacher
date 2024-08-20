<?php

use App\Models\User;
use App\Models\Question;

it('Should be able to list all questions created by me', function(){

    $wrongUser = User::factory()->create();
    $wrongQuestions = Question::factory()->for($wrongUser, 'created_by')->count(10)->create();

    $user = User::factory()->create();
    $questions = Question::factory()->for($user, 'created_by')->count(10)->create();

    \Pest\Laravel\actingAs($user);
    $response = \Pest\Laravel\get(route('question.index'));

    foreach ($questions as $q){
        $response->assertSee($q->$questions);
    }

    foreach ($questions as $q){
        $response->assertDontSee($q->$questions);
    }
});
