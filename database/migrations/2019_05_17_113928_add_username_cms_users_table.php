<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameCmsUsersTable extends Migration
{
    public $set_table = 'cms_users';
    public $set_column = 'username';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn($this->set_table, $this->set_column)) {
            Schema::table($this->set_table, function (Blueprint $table) {
                $table->string($this->set_column, 50)->after('name')->unique();
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
