<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnShippingFeeOrderTable extends Migration
{
    public $set_table = 'orders';
    public $set_column = 'shipping_fee';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->set_table, $this->set_column)) {
            Schema::table($this->set_table, function (Blueprint $table) {
                $table->decimal($this->set_column, 8, 2)->after('shipping_type')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn($this->set_table, $this->set_column)) {
            Schema::table($this->set_table, function (Blueprint $table) {
                $table->dropColumn($this->set_column);
            });
        }
    }
}
