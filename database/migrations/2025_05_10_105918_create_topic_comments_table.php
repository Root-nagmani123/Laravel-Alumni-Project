<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicCommentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('topic_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id');
            $table->unsignedInteger('comment_by');
            $table->text('comment_text');
            $table->timestamp('created_date')->useCurrent()->useCurrentOnUpdate();

            // Optional foreign keys, adjust based on your table structure
            // $table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
            // $table->foreign('comment_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_comments');
    }
}
