<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateFormPhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_form_phases', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('estimate_id')->nullable();
            $table->string('premise_name')->nullable();
            $table->string('phase_name')->nullable();
            $table->text('description')->nullable();
            $table->string('timeline')->nullable();
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
        Schema::dropIfExists('estimate_form_phases');
    }
}
