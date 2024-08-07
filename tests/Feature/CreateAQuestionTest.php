<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to create a new questionn bigger than 255 characters', function () {

    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('a', 260) . '?']);
});

it('Should check if ends with question mark ?', function () {
    expect(true)->toBeTrue();
});

it('Should have at least 10 characters', function () {
    expect(true)->toBeTrue();
});
