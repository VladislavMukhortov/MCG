<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRequestsTable.
 */
class CreateRequestsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('lead');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->tinyInteger('status')->nullable();
            $table->datetime('created',0)->nullable();
            $table->text('request_information')->nullable();
            $table->decimal('floor_plan_attachments')->nullable();
            $table->decimal('existing_condition_attachments')->nullable();
            $table->decimal('concept_photo_attachments')->nullable();
            $table->tinyInteger('floor_plan_uploaded')->nullable();
            $table->tinyInteger('existing_condition_uploaded')->nullable();
            $table->tinyInteger('concept_photo_uploaded')->nullable();
            $table->datetime('attachment_link_sent',0)->nullable();
            $table->integer('type')->default('0');
            $table->integer('stage')->default('0');
            $table->integer('startdate')->default('0');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}
}
