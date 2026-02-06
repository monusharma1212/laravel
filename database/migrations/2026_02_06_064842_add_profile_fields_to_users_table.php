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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->nullable();
            $table->integer('experience')->nullable();
            $table->string('department')->nullable();
            $table->string('resume')->nullable();
            $table->string('theme_color')->nullable();
            $table->integer('skill_level')->nullable();
            $table->string('shift')->nullable();
            $table->boolean('newsletter')->default(0);
            $table->text('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
