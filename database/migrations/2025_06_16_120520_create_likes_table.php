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
       Schema::create('likes', function (Blueprint $table) {
        $table->id(); // This is an auto-incrementing primary key
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('member_id')->constrained()->onDelete('cascade'); // or user_id if using User model
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
