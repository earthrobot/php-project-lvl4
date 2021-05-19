<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->word(),
            // 'description' => $this->faker->paragraph(),
            // 'status_id' => 1,
            // 'created_by_id' => 1,
            // 'assigned_to_id' => 1,
            'name' => $this->faker->name,
            'status_id' => TaskStatus::factory()->create()->id,
            'created_by_id' => User::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id,
            'description' => $this->faker->text(500)
        ];
    }
}
