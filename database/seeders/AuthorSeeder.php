<?php

namespace Database\Seeders;

use App\Models\Authors;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Authors::factory()->count(50)->create();
    }
}
