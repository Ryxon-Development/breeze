<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create first tester admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@tester.com',
            'password' => Hash::make('p4ssw0rd'), // Hash the password
        ]);
        //create another 4 random users
        User::factory()->count(4)->create();
    }
}
