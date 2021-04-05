<?php

namespace Database\Seeders;

use App\Models\ProjectStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!ProjectStatus::count()) {
            ProjectStatus::getStatuses()->each( function ($statusName, $id) {
                try {
                    ProjectStatus::create(['id' => $id, 'name' => $statusName]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
