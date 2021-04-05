<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeadsTable.
 */
class CreateLeadsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('token')->nullable();
            $table->string('lead_referral_source', 150)->nullable();
            $table->datetime('date_of_initial_contact')->nullable();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('phone', 18)->nullable();
            $table->string('status')->nullable();
            $table->index('status');
            $table->tinyInteger('rating')->nullable();
            $table->string('project_type')->nullable();
            $table->text('project_description')->nullable();
            $table->string('budget')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('created')->nullable();
            $table->string('current_estimate')->nullable();
            $table->tinyInteger('logged_in')->default('0');
            $table->unsignedInteger('request')->nullable();
            $table->foreign('request')->references('id')->on('requests')->onDelete('cascade');
            $table->tinyInteger('password_generated')->default('0');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leads');
	}
}
