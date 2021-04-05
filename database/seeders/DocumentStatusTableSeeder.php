<?php

namespace Database\Seeders;

use App\Models\DocumentStatus;
use Illuminate\Database\Seeder;

class DocumentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo refactor firstOrCreate
        if (!DocumentStatus::count()) {
            DocumentStatus::getStatusNames()->each( function ($statusName, $id) {
                try {
                    $title = \Str::of($statusName)->replace('_', ' ')->title()->__toString();
                    DocumentStatus::create(['id' => $id, 'name' => $statusName, 'title' => $title]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
