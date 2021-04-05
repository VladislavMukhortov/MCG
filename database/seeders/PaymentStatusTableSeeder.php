<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!PaymentStatus::count()) {
            PaymentStatus::getStatuses()->each( function ($statusName, $id) {
                try {
                    PaymentStatus::create(['id' => $id, 'name' => $statusName]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
