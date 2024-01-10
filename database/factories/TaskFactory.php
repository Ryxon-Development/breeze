<?php

namespace Database\Factories;

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
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'user_id' => fake()->numberBetween(1, 5),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
            'status' => fake()->randomElement([1, 2, 3]),
            'priority' => fake()->randomElement([1, 2, 3]),
            'created_by' => fake()->numberBetween(1, 5),
            'updated_by' => fake()->numberBetween(1, 5),
            'completed_by' => null,
            'assigned_by' => fake()->numberBetween(1, 5),
            'assigned_to' => fake()->numberBetween(1, 5),
            'comments' => fake()->text,
            'attachments' => fake()->word,
            'tags' => fake()->words(2, true),
            'parent_task_id' => null,
            'dependencies' => null,
            'notifications' => fake()->sentence,
        ];
    }
}
