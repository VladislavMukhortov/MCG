<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEstimateTemplateLineItemsRepositoriesTable.
 */
class CreateEstimateTemplateLineItemsRepositoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estimate_template_line_items_repositories', function(Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('estimate_template_id')->default(0);
			$table->unsignedInteger('csi_code')->nullable();
			$table->string('folder_id')->nullable();
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
		Schema::drop('estimate_template_line_items_repositories');
	}
}
