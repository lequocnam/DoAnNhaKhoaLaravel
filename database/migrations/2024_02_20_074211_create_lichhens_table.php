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
        Schema::create('lichhens', function (Blueprint $table) {
            $table->id();
            $table->string('malichhen');
            $table->string('ten');
            $table->string('gioitinh');
            $table->string('sodienthoai');
            $table->string('diachi');
            $table->string('noidungkham');
            $table->date('ngayhen');
            $table->date('ngaydukien');
            $table->string('trangthai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichhens');
    }
};
