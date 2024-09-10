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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('zoom_id')->unique(); 
            $table->string('uuid')->nullable();
            $table->string('topic'); 
            $table->string('type'); 
            $table->timestamp('start_time'); 
            $table->integer('duration'); 
            $table->text('start_url');
            $table->text('join_url'); 
            $table->text('password'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
