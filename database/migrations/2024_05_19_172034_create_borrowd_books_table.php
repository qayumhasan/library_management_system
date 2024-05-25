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
        Schema::create('borrowd_books', function (Blueprint $table) {
            $table->id();
            $table->date('borrow_date');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('book_id');
            $table->date('return_date')->nullable();
            $table->enum('status', ['Borrowed', 'Returned', 'Overdue']);
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowd_books');
    }
};
