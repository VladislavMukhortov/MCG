<?php

namespace Database\Seeders\Question;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo refactor firstOrCreate
        if (!QuestionType::count()) {
            QuestionType::getTypeNames()->each( function ($typeName, $id) {
                try {
                    $title = \Str::title($typeName);
                    QuestionType::create(['id' => $id, 'name' => $typeName, 'title' => $title]);
                } catch (\Throwable $exception) { report($exception); }
            });
        }
    }
}
