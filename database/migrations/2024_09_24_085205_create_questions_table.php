<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->index();
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->string('question')->nullable();
            $table->string('option-a')->nullable();
            $table->string('option-b')->nullable();
            $table->string('option-c')->nullable();
            $table->string('option-d')->nullable();
            $table->string('option-ans')->nullable();
            $table->string('descriptive_question')->nullable();
            $table->string('marks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};