<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_auth', function (Blueprint $table) {
            $table->bigIncrements('auth_id');
            $table->tinyInteger('auth_pid');
            $table->string('auth_c',65)->nullable();
            $table->string('auth_a',25)->nullable();
            $table->string('auth_d')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_auth');
    }
}
