<?php
declare(strict_types=1);

use App\Models\TaskListModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it ('shows task list', function () {
    $taskList = TaskListModel::factory()->create();

    $response = getJson('/api/task-lists/' . $taskList->id);
    $response->assertOk();
    $response->assertJsonFragment([
        'id' => $taskList->id,
        'name' => $taskList->name,
    ]);
});

it ('returns error message when task list does not exist', function () {
    $response = getJson('/api/task-lists/0');
    $response->assertNotFound();
});
