<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id')->nullable();
        //    $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->integer('stage_room')->nullable();
            $table->integer('ceiling')->nullable();
            $table->integer('walls')->nullable();
            $table->integer('wall_partition')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('baseboard')->nullable();
            $table->integer('crown_molding')->nullable();
            $table->integer('interior_door')->nullable();
            $table->integer('closest_door')->nullable();
            $table->integer('closest_organization')->nullable();
            $table->integer('window')->nullable();
            $table->integer('light_fixture')->nullable();
            $table->text('room_size')->nullable();
            $table->text('room_info')->nullable();
            $table->text('room_inspiration_external')->nullable();
            $table->integer('recessed_light')->nullable()->unsigned();
            $table->integer('wall_fixture')->nullable()->unsigned();
            $table->integer('ceiling_fixture')->nullable()->unsigned();
            $table->integer('bathroom_current')->nullable()->unsigned();
            $table->integer('bathroom_replace')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
}
