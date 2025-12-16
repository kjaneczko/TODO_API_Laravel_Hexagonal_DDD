<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('renames task list', function () {
    $model = TaskListModel::factory()->create();

    $response = getJson('/api/task-lists/' . $model->id);
    $response->assertOk();
    $response->assertJsonFragment([
        'id' => $model->id,
        'name' => $model->name,
    ]);
});

it ('returns error message when task list does not exist', function () {
    $response = getJson('/api/task-lists/0');
    $response->assertNotFound();
});
