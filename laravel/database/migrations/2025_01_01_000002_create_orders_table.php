<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    public function up() {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('worker_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['pending','in_progress','completed','cancelled'])->default('pending');
            $table->dateTime('deadline')->nullable();
            $table->boolean('paid')->default(false);
            $table->timestamps();
            });
        }
    }
    public function down() {
        Schema::dropIfExists('orders');
    }
}
