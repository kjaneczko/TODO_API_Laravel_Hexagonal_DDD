<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('assign task to another task list', function () {
    $model1 = TaskModel::factory()->create();
    $model2 = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $model1->id . '/assign-to-task-list', ['task_list_id' => $model2->task_list_id]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $model1->id, 'task_list_id' => $model2->task_list_id]);
});
