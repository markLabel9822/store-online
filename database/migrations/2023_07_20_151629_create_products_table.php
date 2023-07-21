<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('status');
            $table->unsignedBigInteger('product_category_id');
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
