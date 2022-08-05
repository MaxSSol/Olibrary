<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $role = Role::factory()
            ->count(3)
            ->state(new Sequence(
                ['title' => 'Moderator', 'slug' => 'moder'],
                ['title' => 'User', 'slug' => 'user'],
                ['title' => 'Admin', 'slug' => 'admin'],
            ))
            ->create();
        User::factory(10)->hasAttached($role)->create();

    }
}
