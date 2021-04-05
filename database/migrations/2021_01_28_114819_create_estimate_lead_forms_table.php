<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateLeadFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_lead_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estimate_id')->nullable();
            $table->unsignedInteger('premise_id')->nullable();
            $table->unsignedInteger('phase_id')->nullable();
            $table->string('file')->nullable();
            $table->unsignedInteger('page_number')->nullable();
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
        Schema::dropIfExists('estimate_lead_forms');
    }
}
