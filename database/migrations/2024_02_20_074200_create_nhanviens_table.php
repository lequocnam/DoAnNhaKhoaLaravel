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
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->id();
            $table->string('anh');
            $table->string('manhanvien');
            $table->string('ten');
            $table->date('ngaysinh');
            $table->string('gioitinh');
            $table->string('diachi');
            $table->string('sodienthoai');
            $table->string('cmnd');
            $table->string('email');
            $table->string('loai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhanviens');
    }
};
