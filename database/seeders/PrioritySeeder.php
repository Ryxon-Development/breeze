<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //now create 3 priorities
        DB::table('priorities')->insert([
            ['label' => 'Low'],
            ['label' => 'Medium'],
            ['label' => 'High'],
        ]);
    }
}
