<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsiCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csi_codes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('code_name');
            $table->unsignedInteger('level_1_id')->nullable();
            $table->unsignedInteger('level_2_id')->nullable();
            $table->unsignedInteger('level_3_id')->nullable();
            $table->unsignedInteger('level_4_id')->nullable();
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
        Schema::dropIfExists('csi_codes');
    }
}
