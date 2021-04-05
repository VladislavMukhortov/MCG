<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEstimateTemplateRepositoriesTable.
 */
class CreateEstimateTemplateRepositoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estimate_template_repositories', function(Blueprint $table) {
            $table->increments('id');
			$table->string('template_name');
			$table->string('total')->nullable();
			$table->integer('created_by')->nullable();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estimate_template_repositories');
	}
}
