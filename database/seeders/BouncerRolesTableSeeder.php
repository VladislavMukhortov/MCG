<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BouncerRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('roles')) {
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_REPRESENTATIVE,
                'title' => User::ROLE_REPRESENTATIVE,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_MANAGER,
                'title' => User::ROLE_MANAGER,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_SUBCONTRACTOR,
                'title' => User::ROLE_SUBCONTRACTOR,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_GENERAL_CONTRACTOR,
                'title' => User::ROLE_GENERAL_CONTRACTOR,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_LEAD,
                'title' => User::ROLE_LEAD,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_ADMIN,
                'title' => User::ROLE_ADMIN,
            ]);
            \Bouncer::role()->firstOrCreate([
                'name'  => User::ROLE_WORKER,
                'title' => User::ROLE_WORKER,
            ]);
        }
    }
}
