<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTasksTable.
 */
class CreateTasksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('parent_task')->nullable();
            $table->foreign('parent_task')->references('id')->on('tasks');
			$table->string('status')->nullable();
            $table->datetime('due_date')->nullable();
			$table->integer('created_by')->nullable();
			$table->foreignId('subcontractor')->nullable();
			$table->integer('project')->nullable();	
			$table->integer('lead')->nullable();
			$table->integer('assigned_rep')->nullable();
            $table->text('display_name')->nullable();
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
		Schema::drop('tasks');
	}
}
