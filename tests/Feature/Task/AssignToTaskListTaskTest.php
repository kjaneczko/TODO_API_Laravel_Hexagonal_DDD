<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('assign task to another task list', function () {
    $task1 = TaskModel::factory()->create();
    $task2 = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task1->id . '/assign-to-task-list', ['task_list_id' => $task2->task_list_id]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task1->id, 'task_list_id' => $task2->task_list_id]);
});

it ('assign task to non-existing task list', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/assign-to-task-list', ['task_list_id' => 0]);
    $response->assertNotFound();
});
