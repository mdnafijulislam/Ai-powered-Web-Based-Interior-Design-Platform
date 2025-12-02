<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relationship Fields
            $table->foreignId('worker_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();

            // Project Information
            $table->string('project_title');
            $table->string('project_type')->nullable();
            $table->text('description')->nullable();

            // Status
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])
                  ->default('pending');

            // Budget & Payment
            $table->decimal('budget', 10, 2)->nullable();
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])
                  ->default('unpaid');

            // Deadline
            $table->date('deadline')->nullable();

            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
