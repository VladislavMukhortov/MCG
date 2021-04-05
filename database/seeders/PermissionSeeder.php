<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Bouncer;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::ability()->firstOrCreate([
            'name' => 'users.create',
            'title' => 'Create Users',
        ]);
       Bouncer::ability()->firstOrCreate([
            'name' => 'users.edit',
            'title' => 'Edit Users',
        ]);
       Bouncer::ability()->firstOrCreate([
            'name' => 'users.delete',
            'title' => 'Delete Users',
        ]);
    }
}
