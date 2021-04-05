<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateWalkthrough extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_walkthrough', function (Blueprint $table) {
            $table->id();
            $table->integer('estimate_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('details')->nullable();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->timestamp('meeting_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_walkthrough');
    }
}
