<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

it ('updates a task list', function () {
    $taskList = TaskListModel::factory()->create();
    $name = 'New name';

    $response = putJson('/api/task-lists/' . $taskList->id, ['name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('task_lists', ['id' => $taskList->id, 'name' => $name]);
});

it ('returns validation errors when updating a task list with an empty name', function() {
    $taskList = TaskListModel::factory()->create();

    $response = putJson('/api/task-lists/' . $taskList->id, ['name' => '']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});

it ('returns 404 when updating a non-existing task list', function() {
    $response = putJson('/api/task-lists/0', ['name' => '1234']);
    $response->assertNotFound();
});
