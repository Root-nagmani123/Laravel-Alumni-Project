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
        /* Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        }); */
		Schema::create('notification', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('group_id')->nullable(); 
            $table->integer('forum_id')->nullable(); 
            $table->integer('topic_id')->nullable(); 
            $table->integer('live_id')->nullable(); 
            $table->text('message')->nullable(); 
            $table->string('type', 100)->nullable(); 
            $table->integer('show')->nullable(); 
            $table->integer('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
