<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_order_id');
            $table->foreign('main_order_id')->references('id')->on('main_orders');
            $table->unsignedBigInteger('id_product');
            $table->string('product_name');
            $table->decimal('product_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailed_orders');
    }
};
