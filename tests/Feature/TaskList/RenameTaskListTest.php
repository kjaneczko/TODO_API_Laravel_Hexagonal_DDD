<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('renames a task list', function () {
    $taskList = TaskListModel::factory()->create();
    $name = 'My Task List';

    $response = patchJson('/api/task-lists/' . $taskList->id . '/rename', ['name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('task_lists', ['id' => $taskList->id, 'name' => $name]);
});

it ('returns validation errors when renaming a task list with an empty name', function() {
    $taskList = TaskListModel::factory()->create();

    $response = patchJson('/api/task-lists/' . $taskList->id . '/rename', ['name' => '']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});
