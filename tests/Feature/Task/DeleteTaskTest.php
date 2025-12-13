<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('delete task', function () {
    // 1. Create new task
    $name = 'test task';
    $response = postJson('/api/tasks', ['name' => $name]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', ['id' => $id, 'name' => $name]);

    // 2. delete task
    $response = deleteJson('/api/tasks/'.$id);
    $response->assertOk();

    $this->assertDatabaseMissing('tasks', ['id' => $id]);
});
