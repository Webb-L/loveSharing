<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char("title");
            $table->string("url");
            $table->bigInteger('playback')->default(0);
            $table->bigInteger('users_id');
            $table->string("displaymap");
            $table->enum('status',[1,2])->default(1)->comment("1=审核中，2=通过");
            $table->softDeletes();
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
        Schema::dropIfExists('video_list');
    }
}
