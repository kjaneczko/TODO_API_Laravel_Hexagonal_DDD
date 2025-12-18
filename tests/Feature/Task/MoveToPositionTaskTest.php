<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('moves a task to a new position', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/move_to_position', ['position' => 6]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'position' => 6]);
});

it ('shows errors for not integer position', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/move_to_position', ['position' => 'abc']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('position');
});

it ('shows errors for position number below 0', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/move_to_position', ['position' => -1]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('position');
});
