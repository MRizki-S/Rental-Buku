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
        Schema::create('rent_logs', function (Blueprint $table) {
            $table->id();
            // foreign key user_id ke users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //foreign key book_id ke books
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');

            // column tanggal peminjaman
            $table->date('rent_date');
            // column tanggal pengembalian buku (maksimal 3 hari)
            $table->date('return_date');
            // column kapan buku itu benar benar di kembalikan
            $table->date('actual_return-date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_log_');
    }
};
