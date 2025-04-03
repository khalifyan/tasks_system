<?php

namespace Database\Factories;

use App\Enums\TasksStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(100),
            'description' => fake()->text(),
            'status' => TasksStatus::new->value,
            'user_id' => User::factory()->create()->id,
        ];
    }

    public function createUser(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory()->create()->id,
            ];
        });
    }

    public function createRelations(): self
    {
        return $this->createUser();
    }
}
