<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

it ('updates task list', function () {
    $model = TaskListModel::factory()->create();
    $name = 'New name';

    $response = putJson('/api/task-lists/' . $model->id, ['name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('task_lists', ['id' => $model->id, 'name' => $name]);
});

it ('returns error message when updating task list with empty name', function() {
    $model = TaskListModel::factory()->create();

    $response = putJson('/api/task-lists/' . $model->id, ['name' => '']);
    $response->assertUnprocessable();
});
