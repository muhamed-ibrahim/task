<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'phone_number' => '01012345678',
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'phone_number' => '011' . $faker->numberBetween(10000000, 99999999),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'phone_number' => '012' . $faker->numberBetween(10000000, 99999999),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'phone_number' => '015' . $faker->numberBetween(10000000, 99999999),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'phone_number' => '011' . $faker->numberBetween(10000000, 99999999),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'phone_number' => '011' . $faker->numberBetween(10000000, 99999999),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
