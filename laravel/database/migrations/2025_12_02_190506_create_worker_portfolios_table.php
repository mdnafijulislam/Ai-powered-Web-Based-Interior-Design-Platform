<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('users')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable(); // Bedroom, Living Room, Full Flat, etc.
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // main image filename
            $table->string('before_image')->nullable(); // optional before image
            $table->string('after_image')->nullable();  // optional after image
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_portfolios');
    }
};
