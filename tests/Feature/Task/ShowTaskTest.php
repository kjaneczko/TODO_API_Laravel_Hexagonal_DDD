<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it('shows task', function () {
    $task = TaskModel::factory()->create();

    $response = getJson('/api/tasks/' . $task['id']);
    $response->assertOk();
    $response->assertJsonFragment([
        'id' => $task['id'],
        'name' => $task['name'],
    ]);
});

it('shows error task not found', function () {
    $response = getJson('/api/tasks/10000');
    $response->assertNotFound();
});
