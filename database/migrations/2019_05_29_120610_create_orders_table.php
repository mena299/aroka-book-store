<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('customer_id');
            $table->string('shipping_name');
            $table->text('customer_remark');
            $table->text('staff_remark');
            $table->enum('status', ['waiting', 'progress', 'done', 'cancel', 'refunded']);
            $table->enum('shipping_type', ['register', 'ems']);
            $table->dateTime('shipping_datetime');
            $table->string('tracking', 100);
            $table->decimal('full_price', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->decimal('net_price', 12, 2);
            $table->string('shipping_address');
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
