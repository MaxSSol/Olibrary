<?php

namespace Database\Seeders;

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
        $this->call([
           AuthorSeeder::class,
           BookSeeder::class,
           AuthorBookSeeder::class,
           CategorySeeder::class,
           CategoryBookSeeder::class,
           UserSeeder::class,
           UserRoleSeeder::class
        ]);
    }
}
