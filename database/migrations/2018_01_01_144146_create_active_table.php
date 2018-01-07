<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_actives', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->boolean('isActive');
            $table->string('token');

        });

        Schema::table('user_actives', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_actives',function(Blueprint $table){
            $table->dropForeign('active_user_id_foreign');
        });
        Schema::dropIfExists('user_actives');
    }
}
