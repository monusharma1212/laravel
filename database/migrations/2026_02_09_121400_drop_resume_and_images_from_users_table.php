<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'resume')) {
                $table->dropColumn('resume');
            }
            if (Schema::hasColumn('users', 'images')) {
                $table->dropColumn('images');
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('resume')->nullable();
            $table->json('images')->nullable();
        });
    }
    
};
