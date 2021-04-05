<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@indiviar.com'],
            [
                'name'          => 'Admin',
                'user_status'   => User::STATUS_ACTIVE,
                'password'      => \Hash::make('password')
            ]
        );

    }
}
