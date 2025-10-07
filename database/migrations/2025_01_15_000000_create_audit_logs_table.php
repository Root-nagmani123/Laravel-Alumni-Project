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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('ip_address', 45); // IPv6 compatible
            $table->timestamp('timestamp');
            $table->string('username')->nullable(); // No password stored
            $table->string('session_id')->nullable();
            $table->text('referrer_url')->nullable();
            $table->integer('process_id')->nullable();
            $table->text('url_accessed');
            $table->text('user_agent');
            $table->string('country', 100)->nullable();
            $table->enum('action_type', ['login_success', 'login_failed', 'logout', 'page_access', 'api_call']);
            $table->text('request_data')->nullable(); // JSON data for additional context
            $table->string('http_method', 10)->nullable();
            $table->integer('response_code')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['timestamp', 'action_type']);
            $table->index(['ip_address', 'timestamp']);
            $table->index(['username', 'timestamp']);
            $table->index('action_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
