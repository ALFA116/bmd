<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('users_id');
            $table->enum('status', ['ditransfer', 'dibayar', 'diambil', 'approved', 'rejected', 'Menunggu']);
            $table->string('order_code', 255);
            $table->double('price');
            $table->integer('quantity')->default(1);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
