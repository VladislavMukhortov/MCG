<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubContractorsTable.
 */
class CreateSubContractorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcontractors', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('primary_contact_name')->nullable();
            $table->string('phone',18)->nullable();
            $table->text('address')->nullable();
            $table->text('website')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('has_project')->nullable();
            $table->tinyInteger('vendor_source')->nullable();
            $table->foreignId('parent_vendor')->nullable()->references('id')->on('subcontractors');
            $table->foreignId('status_id')->nullable()->constrained('subcontractor_statuses')->onDelete('cascade');
            $table->integer('csi_code')->nullable();
            $table->tinyInteger('entity_type')->nullable();
            $table->tinyInteger('workers_compensation')->nullable();
            $table->tinyInteger('licensed')->nullable();
            $table->tinyInteger('general_liability')->nullable();
            $table->text('crew_size')->nullable();
            $table->text('languages')->nullable();
            $table->tinyInteger('drivers_license')->nullable();
            $table->tinyInteger('has_tools')->nullable();
            $table->tinyInteger('has_vehicle')->nullable();
            $table->text('years_of_experience')->nullable();
            $table->string('w9_uploaded')->nullable();
            $table->string('coi_uploaded')->nullable();
            $table->string('license_uploaded')->nullable();
 
		});
            
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subcontractors');
	}
}
