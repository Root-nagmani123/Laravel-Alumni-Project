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
       /*  Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        }); */
		Schema::create('forums', function (Blueprint $table) {
            $table->increments('id'); // Auto-incrementing ID
            $table->string('name', 255); 
            $table->integer('cat_id')->nullable();
			$table->integer('status')->nullable(); 
			$table->integer('created_by'); // Created by 
            $table->timestamp('created_at')->useCurrent()->nullable(false); // Created at
			$table->timestamp('updated_at')->nullable(); // Add the updated_at column
        });
    }	

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
		//$table->dropColumn('updated_at'); // Drop the updated_at column if the migration is rolled back
    }
};
