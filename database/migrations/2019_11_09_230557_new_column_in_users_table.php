<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('registered_from_ip')->nullable();
            $table->string('last_ip')->nullable();
            $table->datetime('last_login')->nullable();
            $table->integer('blocked')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('registered_from_ip');
            $table->dropColumn('last_ip');
            $table->dropColumn('last_login');
            $table->dropColumn('blocked');
        });
    }
}
