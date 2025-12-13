<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('update task', function () {
    // 1. Create new task
    $name = 'test task';
    $response = postJson('/api/tasks', ['name' => $name]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', ['id' => $id, 'name' => $name]);

    // 2. Update task name
    $name = 'updated name';
    $response = patchJson('/api/tasks', ['id' => $id, 'name' => $name]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $id, 'name' => $name]);
});
