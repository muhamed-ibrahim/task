<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id')->all();


        DB::table('posts')->insert([
            [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '011' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '012' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '011' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '015' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '012' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(3),
                'phone_number' => '010' . $faker->numberBetween(10000000, 99999999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
