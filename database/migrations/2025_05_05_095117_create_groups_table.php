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
       Schema::create('groups', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('member_type')->nullable()->comment('1=admin,2=member');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
