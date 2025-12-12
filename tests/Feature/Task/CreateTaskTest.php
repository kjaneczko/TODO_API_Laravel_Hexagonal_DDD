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

it ('shows errors for empty value', function () {
    $response = postJson('/api/tasks', ['value' => '']);
    $response->assertUnprocessable();
});

it ('shows errors for value of length over 255', function () {
    $response = postJson('/api/tasks', [
        'value' => '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'.
            '12345678901234567890123456789012345678901234567890'
    ]);
    $response->assertUnprocessable();
});
