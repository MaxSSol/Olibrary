<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::factory()->create([
            'title' => 'Moderator',
            'slug' => 'moder'
        ]);
        User::factory(1)->hasAttached($role)->create();

    }
}
