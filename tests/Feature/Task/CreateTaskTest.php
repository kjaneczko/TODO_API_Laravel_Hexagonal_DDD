<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('create task', function () {
    $value = 'test task';
    $response = postJson('/api/tasks', ['value' => $value]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', ['id' => $id, 'value' => $value]);
});
