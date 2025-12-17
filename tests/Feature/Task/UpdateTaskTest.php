<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

it('update task', function () {
    $task = TaskModel::factory()->create();

    $name = 'updated name';
    $response = putJson('/api/tasks/' . $task->id, ['name' => $name, 'position' => 2, 'completed' => true]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => $name, 'position' => 2, 'completed' => true]);
});

it ('returns error message when updating non existing task', function() {
    $response = putJson('/api/tasks/0', ['name' => '1234']);
    $response->assertNotFound();
});
