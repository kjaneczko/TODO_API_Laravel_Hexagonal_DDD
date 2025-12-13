<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it('shows task', function () {
    $model = TaskModel::factory()->create();

    $response = getJson('/api/tasks/'.$model['id']);
    $response->assertOk();
    $response->assertJsonFragment([
        'id' => $model['id'],
        'name' => $model['name'],
    ]);
});

it('shows error task not found', function () {
    $response = getJson('/api/tasks/10000');
    $response->assertNotFound();
});
