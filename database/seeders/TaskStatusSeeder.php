<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert default task statuses
        DB::table('task_statuses')->insert([
            ['label' => 'Open'],
            ['label' => 'In Progress'],
            ['label' => 'Completed'],
        ]);
    }
}
