<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->mediumInteger('price');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name', 120);
            $table->string('user_email', 200)->nullable();
            $table->string('user_phone', 15);
            $table->string('customer_comment', 500)->nullable();
            $table->string('comment', 500)->nullable();
            $table->enum('status', ['new', 'processing', 'ready to ship', 'shipping', 'arrived', 'completed', 'canceled'])->default('new');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
