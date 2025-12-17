<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('reopen task', function () {
    $task = TaskModel::factory()->create(['completed' => false]);

    $response = patchJson('/api/tasks/' . $task->id . '/reopen');
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => false]);
});
