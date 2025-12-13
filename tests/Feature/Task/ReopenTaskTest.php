<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('reopen task', function () {
    $model = TaskModel::factory()->create(['completed' => true]);

    $response = patchJson('/api/tasks/' . $model->id . '/reopen');
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'completed' => false]);
});
