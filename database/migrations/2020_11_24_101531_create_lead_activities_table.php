<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeadActivitiesTable.
 */
class CreateLeadActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('activities_id')->nullable();
            $table->integer('lead_id')->nullable();
			$table->integer('note_id')->nullable();
			$table->integer('attachment_id')->nullable();
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
		Schema::drop('lead_activities');
	}
}
