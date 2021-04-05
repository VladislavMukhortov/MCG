<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsiCodePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csi_code_prices', function (Blueprint $table) {
            $table->id();
            $table->float('building_materials')->nullable();
            $table->float('decoration_materials')->nullable();
            $table->float('labor')->nullable();
            $table->float('subcontractors')->nullable();
            $table->float('manufacturing')->nullable();
            $table->unsignedBigInteger('code_id')->nullable();
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
        Schema::dropIfExists('csi_codes_prices');
    }
}
