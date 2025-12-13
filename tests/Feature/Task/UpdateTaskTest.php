<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

it('update task', function () {
    $model = TaskModel::factory()->create();

    $name = 'updated name';
    $response = putJson('/api/tasks/'.$model->id, ['name' => $name, 'position' => 2, 'completed' => true]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'name' => $name, 'position' => 2, 'completed' => true]);
});
