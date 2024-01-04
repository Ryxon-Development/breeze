<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 random tasks
        for ($i = 0; $i < 25; $i++) {
            $task = [
                'name' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $faker->numberBetween(1, 5),
                'due_date' => $faker->dateTimeBetween('now', '+30 days'),
                'status' => $faker->randomElement(['Pending', 'In Progress', 'Completed']),
                'priority' => $faker->randomElement(['Low', 'Medium', 'High']),
                'created_by' => $faker->numberBetween(1, 5),
                'updated_by' => $faker->numberBetween(1, 5),
                'completed_by' => null,
                'assigned_by' => $faker->numberBetween(1, 5),
                'assigned_to' => $faker->numberBetween(1, 5),
                'comments' => $faker->text,
                'attachments' => $faker->word,
                'tags' => $faker->words(2, true),
                'parent_task_id' => null,
                'dependencies' => null,
                'notifications' => $faker->sentence,
            ];

            // Insert task into the database
            DB::table('tasks')->insert($task);
        }
    }
}
