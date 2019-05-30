<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutherPenNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_pen_name', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('authors');

            $table->unsignedInteger('pen_name_id');
            $table->foreign('pen_name_id')
                ->references('id')
                ->on('pen_names')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_pen_name');
    }
}
