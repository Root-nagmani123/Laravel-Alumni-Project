<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
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
            $table->tinyInteger('is_deleted')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_topics');
    }
}
