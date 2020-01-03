<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_email');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('pincode');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->float('shipping_charges');
            $table->string('coupon_code');
            $table->float('coupon_amount');
            $table->string('order_status');
            $table->string('payment_method');
            $table->float('grand_total');
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
        Schema::dropIfExists('orders');
    }
}
