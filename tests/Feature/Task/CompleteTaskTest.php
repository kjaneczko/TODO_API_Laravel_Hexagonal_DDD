<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('complete task', function () {
    $model = TaskModel::factory()->create();

    $response = patchJson('/api/tasks/' . $model->id . '/complete');
    $response->assertOk();

    // in database boolean is saved as tinyint
    $this->assertDatabaseHas('tasks', ['id' => $model->id, 'completed' => true]);
});
