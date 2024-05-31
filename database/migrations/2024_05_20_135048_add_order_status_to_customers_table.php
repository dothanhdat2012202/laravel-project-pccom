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
        Schema::table('customers', function (Blueprint $table) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('order_status')->default('Đang chờ xác nhận');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('order_status');
            });
        });
    }
};
