<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku',50);
            $table->string('title_th');
            $table->string('title_en');
            $table->text('content');
            $table->integer('stock');
            $table->unsignedInteger('pen_name_id');
            $table->foreign('pen_name_id')
                ->references('id')
                ->on('pen_names');
            $table->decimal('cost',12,2);
            $table->decimal('register',6,2);
            $table->decimal('ems',6,2);
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
