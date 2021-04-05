<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubcontractorAttachmentsTable.
 */
class CreateSubcontractorAttachmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcontractor_attachments', function(Blueprint $table) {
            $table->increments('id');
            $table->foreignId('subcontractor_id');
			$table->integer('attachment_id');
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
		Schema::drop('subcontractor_attachments');
	}
}
