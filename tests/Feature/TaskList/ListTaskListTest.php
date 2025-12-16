<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;

uses(RefreshDatabase::class);

it ('list task lists', function () {
    $model = TaskModel::factory()->create();

    $response = getJson('/api/task-lists/');
    $response->assertOk();
});
