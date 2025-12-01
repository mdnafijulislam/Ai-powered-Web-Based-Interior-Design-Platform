<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Basic Data
            $table->string('order_key')->unique(); // ORD-20201
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();

            $table->string('project_title');
            $table->string('project_type')->nullable();
            $table->text('description')->nullable();

            // Status
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])
                  ->default('pending');

            // Budget & Payment
            $table->decimal('budget', 12, 2)->default(0);
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');

            // Deadline
            $table->date('deadline')->nullable();

            // Worker assigned
            $table->unsignedBigInteger('worker_id')->nullable();

            // Progress
            $table->integer('progress')->default(0); // 0–100%

            // Deliverables JSON
            $table->json('deliverables')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
