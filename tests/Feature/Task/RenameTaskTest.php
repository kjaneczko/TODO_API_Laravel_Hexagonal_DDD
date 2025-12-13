<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('rename task', function () {
    $model = TaskModel::factory()->create();

    $name = 'new name';
    $response = patchJson('/api/tasks/' . $model->id . '/rename', ['name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'name' => $name]);
});
