<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaskListModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskModel>
 */
class TaskModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'position' => 0,
            'completed' => false,
            'task_list_id' => TaskListModel::factory(),
        ];
    }
}
