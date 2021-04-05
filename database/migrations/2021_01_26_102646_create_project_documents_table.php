<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id');
            $table->string('name');
            $table->string('created_by');
            $table->string('subcontractor')->nullable();
            $table->string('lead')->nullable();
            $table->unsignedInteger('lead_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('date_sent')->nullable();
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
        Schema::dropIfExists('project_documents');
    }
}
