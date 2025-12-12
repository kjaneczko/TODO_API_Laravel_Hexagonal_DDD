<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('update task', function () {
    // 1. Create new task
    $value = 'test task';
    $response = postJson('/api/tasks', ['value' => $value]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', ['id' => $id, 'value' => $value]);

    // 2. Update task value
    $value = 'updated value';
    $response = patchJson('/api/tasks', ['id' => $id, 'value' => $value]);
    $response->assertOk();

    $this->assertDatabaseHas('tasks', ['id' => $id, 'value' => $value]);
});
