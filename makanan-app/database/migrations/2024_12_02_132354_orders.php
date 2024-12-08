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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama pelanggan
        $table->json('makanans'); // Detail makanan dalam format JSON
        $table->json('makanans_id'); // ID makanan dalam format JSON
        $table->integer('total_price'); // Total harga pesanan
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
