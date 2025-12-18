<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it ('lists tasks for a task list', function () {
    $task = TaskModel::factory()->create();
    TaskModel::factory()->count(4)->create(['task_list_id' => $task->task_list_id]);

    $response = getJson('/api/task-lists/' . $task->task_list_id . '/tasks');
    $response->assertOk();
    $response->assertJsonCount(5, 'data');
});

it ('returns 404 when task list is not found', function () {
    $response = getJson('/api/task-lists/0/tasks');
    $response->assertNotFound();
});
