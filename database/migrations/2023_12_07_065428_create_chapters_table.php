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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('content');
            // $table->string('creator')->references('id')->on('users');
            // $table->string('editor')->references('id')->on('users');
            $table->unsignedBigInteger('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('creator')->unsigned();
            $table->foreign('creator')->references('id')->on('users')->default('admin');
            $table->unsignedBigInteger('editor')->unsigned();
            $table->foreign('editor')->references('id')->on('users')->default('admin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
