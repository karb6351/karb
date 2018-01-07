<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_register', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->string('token');
        });

        Schema::table('verify_register', function (Blueprint $table){
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
        Schema::table('verify_register',function(Blueprint $table){
            $table->dropForeign('verify_register_user_id_foreign');
        });
        Schema::dropIfExists('verify_register');
    }
}
