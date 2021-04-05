<?php

namespace Database\Seeders\Question;

use App\Models\QuestionStatus;
use Illuminate\Database\Seeder;

class QuestionStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo refactor firstOrCreate
        if (!QuestionStatus::count()) {
            QuestionStatus::getStatusNames()->each( function ($statusName, $id) {
                try {
                    $title = \Str::of($statusName)->replace('_', ' ')->title()->__toString();
                    QuestionStatus::create(['id' => $id, 'name' => $statusName, 'title' => $title]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
