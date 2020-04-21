<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->double('price', 8, 2);
            $table->double('total_amount', 8, 2);

            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
