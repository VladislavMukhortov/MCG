<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContactsTable.
 */
class CreateContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->nullable();
            $table->string('name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('phone', 18)->nullable();
            $table->string('email');

            $table->foreignId('subcontractor')->nullable()->constrained('subcontractors')->onDelete('cascade');

            $table->foreignId('general_contractor')->nullable()->constrained('general_contractors')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->datetime('created')->nullable();
            $table->unsignedBigInteger('lead')->nullable();
            $table->text('display_name')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts');
	}
}
