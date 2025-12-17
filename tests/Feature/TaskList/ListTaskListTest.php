<?php
declare(strict_types=1);

use App\Models\TaskModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it ('lists task lists', function () {
    TaskModel::factory()->count(5)->create();

    $response = getJson('/api/task-lists/');
    $response->assertOk();

    $response->assertJsonCount(5, 'data');
});
