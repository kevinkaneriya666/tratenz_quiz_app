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
            $table->enum('category', ['1', '2', '3'])->comment('1=math,2=science,3=english');
            $table->string('question',255)->nullable();
            $table->string('answer_1',255)->nullable();
            $table->string('answer_2',255)->nullable();
            $table->string('answer_3',255)->nullable();
            $table->string('answer_4',255)->nullable();
            $table->integer('marks')->unsigned()->default(0);
            $table->timestamps();
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
