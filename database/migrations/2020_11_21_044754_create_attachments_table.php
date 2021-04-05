<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAttachmentsTable.
 */
class CreateAttachmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('attachment_description')->nullable();
			$table->string('status')->nullable();
			$table->string('file')->nullable();
			$table->foreignId('subcontractor')->nullable();
			$table->foreignId('general_contractor')->nullable();
			$table->integer('project')->nullable();
            $table->integer('uploaded_by')->nullable();
			$table->integer('lead')->nullable();
			$table->integer('questions_id')->nullable();
			$table->integer('estimate')->nullable();
			$table->integer('request')->nullable();
			$table->integer('ticket')->nullable();
			$table->integer('line_item')->nullable();
			$table->integer('subcontractor_attachment_type')->nullable();
			$table->integer('estimate_attachment_type')->nullable();
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
		Schema::drop('attachments');
	}
}
