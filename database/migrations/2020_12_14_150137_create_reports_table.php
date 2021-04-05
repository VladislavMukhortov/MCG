<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReportsTable.
 */
class CreateReportsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() //todo
	{
		Schema::create('reports', function(Blueprint $table) {
            $table->id();
            $table->foreignId('subcontractor_id')->nullable()->constrained('subcontractors')->onDelete('cascade');
            $table->unsignedInteger('attachment_id')->nullable();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->text('signature')->nullable();
            $table->text('note')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reports');
	}
}
