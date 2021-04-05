<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNotesTable.
 */
class CreateNotesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes', function(Blueprint $table) {
            $table->increments('id');
            $table->text('notes')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('contact')->nullable();
			$table->integer('task')->nullable();
			$table->foreignId('general_contractor')->nullable();
			$table->foreignId('subcontractor')->nullable();
			$table->integer('project')->nullable();	
			$table->integer('lead')->nullable();
			$table->integer('estimate')->nullable();
			$table->integer('request')->nullable();
			$table->integer('ticket')->nullable();
			$table->integer('line_item')->nullable();
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
		Schema::drop('notes');
	}
}
