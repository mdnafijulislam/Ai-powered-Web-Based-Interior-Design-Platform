<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','role')) {
                $table->string('role')->default('client');
            }
            if (!Schema::hasColumn('users','photo')) {
                $table->string('photo')->nullable();
            }
            if (!Schema::hasColumn('users','is_suspended')) {
                $table->boolean('is_suspended')->default(false);
            }
        });
    }
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role','photo','is_suspended']);
        });
    }
}
