<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should be able to apen a question to edit', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    get(route('question.edit', $question))->assertSuccessful();
});

it('should return a view', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    get(route('question.edit', $question))->assertViewIs('question.edit');
});

it('should make sure that only question with status DRAFT can be edited', function () {
    $user = User::factory()->create();
    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);

    actingAs($user);

    get(route('question.edit', $questionNotDraft))
        ->assertForbidden();
    get(route('question.edit', $draftQuestion))
        ->assertSuccessful();
});

it('should make sure that only person who created the question can edit the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $rightUser->id, 'draft' => true]);

    actingAs($rightUser);

    get(route('question.edit', $question))
        ->assertSuccessful();

    actingAs($wrongUser);
    get(route('question.edit', $question))
        ->assertForbidden();
});
