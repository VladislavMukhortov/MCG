<?php

namespace Database\Seeders\Subcontractor;

use App\Models\SubcontractorStatus;
use Illuminate\Database\Seeder;

class SubcontractorStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo refactor firstOrCreate
        if (!SubcontractorStatus::count()) {
            SubcontractorStatus::getStatusNames()->each( function ($statusName, $id) {
                try {
                    $title = \Str::of($statusName)->replace('_', ' ')->title()->__toString();
                    SubcontractorStatus::create(['id' => $id, 'name' => $statusName, 'title' => $title]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
