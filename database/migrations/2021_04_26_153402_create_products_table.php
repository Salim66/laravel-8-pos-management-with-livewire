<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->longText('description');
            $table->string('brand')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->string('product_code')->nullable();
            $table->text('barcode')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('product_image')->nullable();
            $table->unsignedInteger('alert_stock')->default(100);
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
        Schema::dropIfExists('products');
    }
}
