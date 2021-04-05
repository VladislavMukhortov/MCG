<?php

namespace Database\Seeders;

use App\Models\CSICodeCategory;
use App\Models\CSICodeLevel;
use App\Pivots\CSICodeCategoryAssignment;
use Illuminate\Database\Seeder;

class SeedCSICodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'level' => 1,
                'code' => '02',
                'description' => 'Demolition'
            ],
            [
                'level' => 1,
                'code' => '01',
                'description' => 'Site Preparation & Protection'
            ],
            [
                'level' => 1,
                'code' => '03',
                'description' => 'Interior Framing'
            ],
            [
                'level' => 1,
                'code' => '04',
                'description' => 'Plumbing'
            ],
            [
                'level' => 2,
                'parent' => '02',
                'code' => '30',
                'description' => 'Interior Demolition'
            ],
            [
                'level' => 2,
                'parent' => '02',
                'code' => '10',
                'description' => 'Electrical Fixtures Removal'
            ],
            [
                'level' => 2,
                'parent' => '02',
                'code' => '20',
                'description' => 'Plumbing Appliances Disconnect/Removal'
            ],
            [
                'level' => 3,
                'parent' => ['02', '10'],
                'code' => '12',
                'description' => 'Light Switch/Outlet Removal'
            ],
            [
                'level' => 3,
                'parent' => ['02', '10'],
                'code' => '11',
                'description' => 'Light Fixtures Removal'
            ],
            [
                'level' => 4,
                'parent' => ['02', '10', '11'],
                'code' => '32',
                'description' => 'Light Fixtures Repair'
            ],
        ];

        foreach ($data as $category) {
            try {
                $level = CSICodeLevel::firstOrCreate([
                    'level' => $category['level'],
                    'name' => 'L' . $category['level']
                ]);
//            $dynamicData = [
//                'level_id' => $level->id,
//                'code' => $category['code'],
//                'description' => $category['description'],
//            ];
//
//            CSICodeCategory::create($dynamicData);
            } catch (\Throwable $exception) {
                dump($exception->getMessage());
            }
        }
    }
}
