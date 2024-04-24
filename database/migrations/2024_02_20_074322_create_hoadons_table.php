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
        Schema::create('hoadons', function (Blueprint $table) {
            $table->id();
            $table->string('mahoadon');
            $table->string('mabenhnhan');
            $table->string('tenbenhnhan');
            $table->string('tennhanvien');
            $table->string('htth');
            $table->string('tinhtrang');
            $table->decimal('tongtien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadons');
    }
};
