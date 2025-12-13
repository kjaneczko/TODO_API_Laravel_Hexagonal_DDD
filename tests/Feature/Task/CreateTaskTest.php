<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('create task', function () {
    $name = 'test task';
    $response = postJson('/api/tasks', ['name' => $name]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', ['id' => $id, 'name' => $name]);
});

it ('shows errors for empty name', function () {
    $response = postJson('/api/tasks', ['name' => '']);
    $response->assertUnprocessable();
});

it ('shows errors for name of length over 255', function () {
    $response = postJson('/api/tasks', [
        'name' => '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'
    ]);
    $response->assertUnprocessable();
});
