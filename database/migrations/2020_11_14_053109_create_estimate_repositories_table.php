<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEstimateRepositoriesTable.
 */
class CreateEstimateRepositoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('estimate_repositories')) {
			Schema::create('estimate_repositories', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('lead_id');
                $table->integer('job_id');
				$table->string('job_name')->nullable();
 				$table->dateTime('date_sent')->nullable();
				$table->integer('status')->nullable();
				$table->text('reject_reason')->nullable();
				$table->integer('type')->nullable();
				$table->integer('project')->nullable();
				$table->string('total_price')->nullable();
				$table->string('total_cost')->nullable();
				$table->string('pdf_url')->nullable();
				$table->string('cover_photo')->nullable();
				$table->string('signature')->nullable();
				$table->integer('estimate_template')->nullable();
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estimate_repositories');
	}
}
