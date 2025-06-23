<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->text('content')->nullable();
            $table->enum('media_type', ['live', 'photo_video', 'none'])->default('none');
            $table->string('video_link')->nullable();
            $table->text('media_path')->nullable();
            $table->timestamps();

            // Optional: Add a foreign key if there's a users or members table
            // $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
