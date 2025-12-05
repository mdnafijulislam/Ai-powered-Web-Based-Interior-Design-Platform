<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration {
    public function up() {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('status',['pending','released'])->default('pending');
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('payouts');
    }
}
