<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, postJson};

it('should be able to create a new questionn bigger than 255 characters', function () {

    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 260) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('a', 260) . '?']);
});

it('should create a new question as a draft all the time', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 260) . '?',
    ]);

    assertDatabaseHas('questions', ['question' => str_repeat('a', 260) . '?', 'draft' => true]);
});

it('Should check if ends with question mark ?', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question? It is missing question mark in the end']);
    assertDatabaseCount('questions', 0);
});

it('Should have at least 10 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});

it('only authenticated users can create a new question', function () {
    $request = post(route('question.store'), [
        'question' => str_repeat('a', 8) . '?',
    ])->assertRedirect(route('login'));
});

it("question should be unique", function () {
    $user = User::factory()->create();
    actingAs($user);

    Question::factory()->create(['question' => 'Alguma pergunta?']);

    post(route('question.store'), [
        'question' => 'Alguma pergunta?'
    ])->assertSessionHasErrors(['question' => 'Pergunta já existe!']);
});
