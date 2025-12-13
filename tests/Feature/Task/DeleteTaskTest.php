<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;

uses(RefreshDatabase::class);

it('delete task', function () {
    $model = TaskModel::factory()->create();
    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'name' => $model->name, 'position' => $model->position, 'completed' => $model->completed]);

    $response = deleteJson('/api/tasks/'.$model->id);
    $response->assertOk();

    $this->assertDatabaseMissing('tasks', ['id' => $model->id]);
});
