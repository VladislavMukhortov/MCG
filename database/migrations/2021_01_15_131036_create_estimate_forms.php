<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('estimate_id');
            $table->integer('type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('design_pros')->nullable();
            $table->string('design_cons')->nullable();
            $table->string('design_question')->nullable();
            $table->string('work_add')->nullable();
            $table->string('work_remove')->nullable();
            $table->string('work_change')->nullable();
            $table->string('work_question')->nullable();
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
        Schema::dropIfExists('estimate_forms');
    }
}
