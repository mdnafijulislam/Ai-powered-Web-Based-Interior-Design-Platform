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

            // Client & Worker relations
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('worker_id');

            // Optional: if booking is created from a portfolio item
            $table->unsignedBigInteger('portfolio_id')->nullable();

            // Booking details
            $table->string('status')->default('pending'); // pending, accepted, rejected, completed
            $table->date('preferred_date')->nullable();
            $table->text('message')->nullable();
            $table->decimal('budget', 12, 2)->nullable();

            $table->timestamps();

            // foreign keys
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('portfolio_id')->references('id')->on('worker_portfolios')->onDelete('set null');
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
