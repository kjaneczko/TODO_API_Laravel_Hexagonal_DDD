<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('complete task', function () {
    $task = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $task->id . '/complete');
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => true]);
});
