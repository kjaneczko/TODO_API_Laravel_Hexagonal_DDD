<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('move to position task', function () {
    $model = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $model->id . '/move_to_position', ['position' => 6]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'position' => 6]);
});
