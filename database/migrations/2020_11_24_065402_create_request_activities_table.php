<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRequestActivitiesTable.
 */
class CreateRequestActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('activities_id')->nullable();
            $table->integer('request_id')->nullable();
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
		Schema::drop('request_activities');
	}
}
