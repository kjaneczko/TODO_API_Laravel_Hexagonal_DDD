<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

it ('returns error message when updating non existing task list', function() {
    $response = putJson('/api/task-lists/0', ['name' => '1234']);
    $response->assertNotFound();
});
