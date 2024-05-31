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
        Schema::create('imeis', function (Blueprint $table) {
            $table->id();
            $table->string('imei')->unique();
            $table->bigInteger('product_id'); // Thay đổi kiểu dữ liệu của cột product_id từ integer sang bigInteger
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            // Thiết lập khóa ngoại tới bảng products với ràng buộc restrict
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imeis');
    }
};
