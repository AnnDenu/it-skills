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
        Schema::create('shedules', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->time('sunrise'); //00:00:00
            $table->date('date');

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('theme_id')->unsigned();
            $table->foreign('theme_id')->references('id')->on('themes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shedules');
    }
};
