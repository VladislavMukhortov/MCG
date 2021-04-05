<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateRepositoryLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_repository_line_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estimate_id');
            $table->unsignedInteger('csi_code')->nullable();
            $table->string('folder')->nullable();

            $table->timestamps();

            $table->foreign('estimate_id')->references('id')->on('estimate_repositories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_repository_line_items');
    }
}
