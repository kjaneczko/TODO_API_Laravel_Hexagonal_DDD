<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('rename task', function () {
    $task = TaskModel::factory()->create();

    $name = 'new name';
    $response = patchJson('/api/tasks/' . $task->id . '/rename', ['name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => $name]);
});

it ('rename task - shows errors for empty name', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/rename', ['name' => '']);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('name');
});

it ('rename task - shows errors for name of length over 255', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/rename', [
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
