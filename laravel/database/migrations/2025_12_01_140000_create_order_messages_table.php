<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_messages')) {
            Schema::create('order_messages', function (Blueprint $table) {
                $table->id();

                // Keep original columns to match any existing table schema
                $table->unsignedBigInteger('order_id');
                $table->string('sender'); // worker / client / admin
                $table->text('message')->nullable();
                $table->string('attachment')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_messages');
    }
};
                    $table->timestamps();
