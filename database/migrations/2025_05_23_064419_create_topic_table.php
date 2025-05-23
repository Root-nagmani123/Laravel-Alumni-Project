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
       Schema::create('topic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('images')->nullable();
            $table->string('files')->nullable();
            $table->string('video')->nullable();
            $table->string('video_link')->nullable();
            $table->string('live_video')->nullable();
            $table->string('video_caption')->nullable();
            $table->integer('status')->nullable();
            $table->integer('forum_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->boolean('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic');
    }
};
