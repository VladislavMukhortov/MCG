<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('description');
            $table->foreignId('status_id')->default(\App\Models\QuestionStatus::STATUS_NEW)->constrained('question_statuses')->onDelete('cascade');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('lead_id')->nullable();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->unsignedInteger('estimate_id')->nullable();
            $table->foreignId('type_id')->nullable()->constrained('question_types')->onDelete('cascade');
            $table->foreignId('subcontractor_id')->nullable();
            $table->foreignId('line_item_id')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
