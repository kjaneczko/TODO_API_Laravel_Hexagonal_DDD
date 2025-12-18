<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('creates task', function () {
    $taskList = TaskListModel::factory()->create();

    $name = 'test task';
    $response = postJson('/api/tasks', [
        'name' => $name,
        'task_list_id' => $taskList->id,
        'position' => 1,
        'completed' => false,
    ]);
    $response->assertCreated();
    $id = $response->json('data')['id'];

    $this->assertDatabaseHas('tasks', [
        'id' => $id,
        'name' => $name,
        'task_list_id' => $taskList->id,
        'position' => 1,
        'completed' => false,
    ]);
});

it('returns 404 when creating a task for a non-existing task list', function () {
    $name = 'test task';
    $response = postJson('/api/tasks', [
        'name' => $name,
        'task_list_id' => 0,
        'position' => 1,
        'completed' => false,
    ]);
    $response->assertNotFound();
});

it ('returns validation errors when name is empty', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'name' => '',
        'task_list_id' => $taskList->id,
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});

it ('returns validation errors when name is longer than 255 characters', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'task_list_id' => $taskList->id,
        'name' => '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890',
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});

it ('returns validation errors when position is not an integer', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'name' => 'test',
        'task_list_id' => $taskList->id,
        'position' => 'abc',
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('position');
});

it ('returns validation errors when position is below 0', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'name' => 'test',
        'task_list_id' => $taskList->id,
        'position' => -10,
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('position');
});

it ('returns validation errors when position is greater than 255', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'name' => 'test',
        'task_list_id' => $taskList->id,
        'position' => 300,
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('position');
});

it ('returns validation errors when completed is not a boolean', function () {
    $taskList = TaskListModel::factory()->create();

    $response = postJson('/api/tasks', [
        'name' => 'test',
        'task_list_id' => $taskList->id,
        'completed' => 'abc',
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('completed');
});
