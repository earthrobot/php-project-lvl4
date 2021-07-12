<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TaskStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'created_by_id' => User::factory()->create()->id
        ];
    }
}
