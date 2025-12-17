<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it ('creates task list', function () {
    $name = 'My Task List';

    $response = postJson('/api/task-lists', ['name' => $name]);
    $response->assertCreated();

    $this->assertDatabaseHas('task_lists', ['name' => $name]);
});

it ('returns error message when creating task list with empty name', function() {
    $response = postJson('/api/task-lists', ['name' => '']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});
