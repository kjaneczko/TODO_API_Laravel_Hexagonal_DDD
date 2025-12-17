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

it('lists two from second page tasks', function () {
    $task = TaskModel::factory()->count(4)->create();

    $response = getJson('/api/tasks?page=2&limit=2');
    $response->assertOk();

    $response->assertJsonCount(2, 'data');

    $response->assertJsonFragment([
        'id' => $task[3]->id,
        'name' => $task[3]->name,
    ]);
});

it ('shows errors for page number below zero', function () {
    $response = getJson('/api/tasks?page=-1');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('page');
});

it ('shows errors for page number over big integer', function () {
    $response = getJson('/api/tasks?page=100000000000000000000000000000000000000000');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('page');
});

it ('shows errors for limit below one', function () {
    $response = getJson('/api/tasks?limit=0');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});

it ('shows errors for limit over one hundred', function () {
    $response = getJson('/api/tasks?limit=101');
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});
