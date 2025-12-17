<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;

uses(RefreshDatabase::class);

it ('deletes task list', function () {
    $taskList = TaskListModel::factory()->create();

    $response = deleteJson('/api/task-lists/' . $taskList->id);
    $response->assertOk();

    $this->assertDatabaseMissing('task_lists', ['id' => $taskList->id]);
});

it ('deletes task list and all tasks', function () {
    $taskList = TaskListModel::factory()->create();
    $task1 = TaskModel::factory()->create(['task_list_id' => $taskList->id]);
    $task2 = TaskModel::factory()->create(['task_list_id' => $taskList->id]);

    $this->assertDatabaseCount('tasks', 2);

    $response = deleteJson('/api/task-lists/' . $taskList->id);
    $response->assertOk();

    $this->assertModelMissing($taskList);
    $this->assertModelMissing($task1);
    $this->assertModelMissing($task2);
});
