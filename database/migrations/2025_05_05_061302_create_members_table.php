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
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('cader')->nullable();
            $table->string('designation')->nullable();
            $table->integer('batch')->nullable();
            $table->integer('token')->nullable();
            $table->integer('role')->nullable();
            $table->integer('status')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('date_of_birth', 100)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('gender', ['', 'male', 'female', 'other']);
            $table->text('address')->nullable();
            $table->enum('marital_status', ['', 'single', 'married', 'divorced']);
            $table->string('school_name')->nullable();
            $table->integer('school_year')->nullable();
            $table->string('undergrad_college')->nullable();
            $table->string('undergrad_degree')->nullable();
            $table->integer('undergrad_year')->nullable();
            $table->string('postgrad_college')->nullable();
            $table->string('postgrad_degree')->nullable();
            $table->integer('postgrad_year')->nullable();
            $table->string('current_designation')->nullable();
            $table->string('current_department')->nullable();
            $table->string('current_location')->nullable();
            $table->text('previous_postings')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->timestamps(); // This will create `created_at` and `updated_at` columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
