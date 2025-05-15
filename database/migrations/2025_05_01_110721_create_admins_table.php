<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto increment
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('password', 150);
            $table->string('mobile', 20);
			$table->string('remember_token', 150)->nullable();
            $table->enum('isAdmin', ['1', '2'])->default('1')->comment('1=Admin, 2=Member');
            $table->enum('isStatus', ['0', '1', '2'])->default('1')->comment('1=Approved, 0=Pending, 2=Disapproved');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
