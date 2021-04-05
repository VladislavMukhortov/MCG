<?php

namespace Database\Seeders;

use App\Models\PayoutStatus;
use Illuminate\Database\Seeder;

class PayoutStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!PayoutStatus::count()) {
            PayoutStatus::getStatuses()->each( function ($statusName, $id) {
                try {
                    PayoutStatus::create(['id' => $id, 'name' => $statusName]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
