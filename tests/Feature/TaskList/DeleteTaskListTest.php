<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('deletes task list', function () {
    $model = TaskListModel::factory()->create();

    $response = deleteJson('/api/task-lists/' . $model->id);
    $response->assertOk();

    $this->assertDatabaseMissing('task_lists', ['id' => $model->id]);
});
