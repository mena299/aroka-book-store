<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_code',15);
            $table->string('bank_name',150);
            $table->decimal('total_balance',12,2);
            $table->decimal('system_fee_balance',12,2);
            $table->decimal('product_price_balance',12,2);
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
        Schema::dropIfExists('bank_account');
    }
}
