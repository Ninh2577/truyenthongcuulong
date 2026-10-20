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
        Schema::create('role_permission_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('actor_name')->nullable();
            $table->string('actor_email')->nullable();
            $table->string('action', 50)->index();
            $table->string('target_type', 50)->index();
            $table->string('target_id', 100)->nullable()->index();
            $table->string('target_name', 255);
            $table->json('before_state')->nullable();
            $table->json('after_state')->nullable();
            $table->json('changed_fields')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('success')->default(true);
            $table->text('reason')->nullable();
            $table->string('sensitivity_level', 20)->default('normal')->index();
            $table->timestamps();

            $table->index(['created_at', 'action']);
            $table->index(['target_type', 'target_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission_audit_logs');
    }
};
