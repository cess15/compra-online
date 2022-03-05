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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->on('products')
                ->references('id');

            $table->foreign('buyer_id')
                ->on('buyers')
                ->references('id');

            $table->foreign('seller_id')
                ->on('sellers')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_products');
    }
};
