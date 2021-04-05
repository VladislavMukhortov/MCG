<?php

namespace Database\Seeders;

use App\Models\Leads;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leads = Leads::all();
        $leads->each( function (Leads $lead) {
            Project::factory(['lead_id' => $lead->id])->count(11)->create();
        });
    }
}
