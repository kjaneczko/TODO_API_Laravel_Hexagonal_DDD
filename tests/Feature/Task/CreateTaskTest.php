<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('create task', function () {
    $name = 'test task';
    $response = postJson('/api/tasks', [
        'name' => $name,
        'position' => 1,
        'completed' => true,
    ]);
    $response->assertCreated();
    $id = $response->json('id');

    $this->assertDatabaseHas('tasks', [
        'id' => $id,
        'name' => $name,
        'position' => 1,
        'completed' => true,
    ]);
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

it ('shows errors for not integer position', function () {
    $response = postJson('/api/tasks', [
        'name' => 'test',
        'position' => 'abc',
    ]);
    $response->assertUnprocessable();
});

it ('shows errors for position number below 0', function () {
    $response = postJson('/api/tasks', [
        'name' => 'test',
        'position' => -10,
    ]);
    $response->assertUnprocessable();
});

it ('shows errors for position number over 255', function () {
    $response = postJson('/api/tasks', [
        'name' => 'test',
        'position' => 300,
    ]);
    $response->assertUnprocessable();
});

it ('shows errors for flag completed different than boolean', function () {
    $response = postJson('/api/tasks', [
        'name' => 'test',
        'completed' => 'abc',
    ]);
    $response->assertUnprocessable();
});
