<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it ('creates a task list', function () {
    $name = 'My Task List';

    $response = postJson('/api/task-lists', ['name' => $name]);
    $response->assertCreated();

    $this->assertDatabaseHas('task_lists', ['name' => $name]);
});

it ('returns validation errors when creating a task list with an empty name', function() {
    $response = postJson('/api/task-lists', ['name' => '']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});
