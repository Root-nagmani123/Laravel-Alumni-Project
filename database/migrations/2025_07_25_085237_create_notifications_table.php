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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
             // Who receives this notification
            $table->unsignedBigInteger('user_id')->nullable();

            // Who triggered the notification (optional)
             $table->unsignedBigInteger('from_user_id')->nullable();

            // Type of notification (like, comment, forum_add, forum_topic, broadcast, etc.)
            $table->string('type');

            // Source (post, forum, topic, broadcast, etc.)
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('source_type')->nullable();

            // Notification message (optional if you want to display custom message)
            $table->text('message');

           // Whether user has read the notification
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
