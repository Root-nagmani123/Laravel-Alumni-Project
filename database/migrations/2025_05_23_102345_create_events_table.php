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
       Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('location')->nullable();
        $table->enum('venue', ['online', 'physical']);
        $table->string('url')->nullable();
        $table->dateTime('start_datetime');
        $table->dateTime('end_datetime');
        $table->string('image')->nullable(); // ← Add this
        $table->timestamps();
		
    $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
