<?php
declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('shows task', function () {
    $value = 'test task';
    $response = postJson('/api/tasks', ['value' => $value]);
    $response->assertCreated();
    $id = $response->json('id');

    $response = getJson('/api/tasks/'.$id);
    $response->assertOk();
    $response->assertJsonFragment([
        'id' => $id,
        'value' => $value,
    ]);
});
