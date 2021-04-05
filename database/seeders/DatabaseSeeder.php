<?php

namespace Database\Seeders;

use Database\Seeders\CSI\CSICodeTableSeeder;
use Database\Seeders\CsiCodePricesTableSeeder;
use Database\Seeders\Question\QuestionStatusTableSeeder;
use Database\Seeders\Question\QuestionTypeTableSeeder;
use Database\Seeders\Subcontractor\SubcontractorStatusTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        $this->call(CSICodeTableSeeder::class);

        $this->call(CSICodeTableSeeder::class);
        $this->call(CsiCodePricesTableSeeder::class);

        $this->call(PermissionSeeder::class);
    	$this->call(AdminUserSeeder::class);
    	$this->call(BouncerRolesTableSeeder::class);

        $this->call(ProjectStatusTableSeeder::class);
        $this->call(QuestionStatusTableSeeder::class);
        $this->call(QuestionTypeTableSeeder::class);
        $this->call(PaymentStatusTableSeeder::class);
        $this->call(PayoutStatusTableSeeder::class);
        $this->call(SubcontractorStatusTableSeeder::class);
        $this->call(DocumentStatusTableSeeder::class);


//        $this->call(SeedCSICodes::class);

        //$this->call(SeedCSICodes::class);

        $this->call(UserTableSeeder::class);
        $this->call(DocumentTableSeeder::class);
//        $this->call(ProjectTableSeeder::class); ;;
    }
}
