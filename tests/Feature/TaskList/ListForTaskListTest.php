<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it ('shows list of tasks for task list', function () {
    $task = TaskModel::factory()->create();
    TaskModel::factory()->count(4)->create(['task_list_id' => $task->task_list_id]);

    $response = getJson('/api/task-lists/' . $task->task_list_id . '/tasks');
    $response->assertOk();
    $response->assertJsonCount(5, 'data');
});

it ('returns error message when task list does not exist', function () {
    $response = getJson('/api/task-lists/0/tasks');
    $response->assertNotFound();
});
