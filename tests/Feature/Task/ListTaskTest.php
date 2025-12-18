<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it('lists tasks', function () {
    $tasks = TaskModel::factory()->count(5)->create();

    $response = getJson('/api/tasks');
    $response->assertOk();

    $response->assertJsonCount(5, 'data');

    $response->assertJsonFragment([
        'id' => $tasks[2]->id,
        'name' => $tasks[2]->name,
    ]);
});

it('lists tasks from the second page', function () {
    $task = TaskModel::factory()->count(4)->create();

    $response = getJson('/api/tasks?page=2&limit=2');
    $response->assertOk();

    $response->assertJsonCount(2, 'data');

    $response->assertJsonFragment([
        'id' => $task[3]->id,
        'name' => $task[3]->name,
    ]);
});

it ('returns validation errors when page is below 0', function () {
    $response = getJson('/api/tasks?page=-1');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('page');
});

it ('returns validation errors when page is too large', function () {
    $response = getJson('/api/tasks?page=100000000000000000000000000000000000000000');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('page');
});

it ('returns validation errors when limit is below 1', function () {
    $response = getJson('/api/tasks?limit=0');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});

it ('returns validation errors when limit is greater than 100', function () {
    $response = getJson('/api/tasks?limit=101');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});
