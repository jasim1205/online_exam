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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('class_id')->index();
            $table->foreign('class_id')->references('id')->on('class_lists')->onDelete('cascade');
            $table->unsignedBigInteger('subject_id')->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->unsignedBigInteger('examtype_id')->index();
            $table->foreign('examtype_id')->references('id')->on('exam_types')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('duration'); // in minutes
            $table->integer('total_marks')->nullable(); // in minutes
            $table->dateTime('start_deadline');
            $table->dateTime('end_deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
