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
        Schema::create('hoadonchitiets', function (Blueprint $table) {
            $table->id();
            $table->string('mahoadon');
            $table->string('mabenhnhan');
            $table->string('madichvusanpham');
            $table->string('tendichvusanpham');
            $table->integer('soluong');
            $table->integer('dongia');
            $table->string('ghichu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadonchitiets');
    }
};
