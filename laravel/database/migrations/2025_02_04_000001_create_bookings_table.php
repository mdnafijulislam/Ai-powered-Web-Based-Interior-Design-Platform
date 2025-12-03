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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('worker_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained('worker_portfolios')->nullOnDelete();

            // Booking details
            $table->string('status')->default('pending'); // pending / accepted / rejected / completed
            $table->date('preferred_date')->nullable();
            $table->text('message')->nullable();
            $table->decimal('budget', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
