<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(BookSeeder::class);
        //$this->call(ConfigSeeder::class);
        User::create([
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'gender' => 1,
            'address' => 'sadasd',
            'roles' => 1,
            'password' => bcrypt('admin'), // password
            'remember_token' => Str::random(10),
            'phone' => 0000000000,
            'firstname' => $faker->name,
            'lastname' => $faker->name
        ])
    }
}
