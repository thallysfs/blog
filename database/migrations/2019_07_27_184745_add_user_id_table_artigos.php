<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdTableArtigos extends Migration
{

    public function up()
    {
        Schema::table('artigos', function (Blueprint $table) {
            //unsigned - não permite inteiros com números negativos
            $table->integer('user_id')->unsigned()->default(1);
            //definindo chave estrangeira. onDelete('cascade') - se o usuário for deletado, todos os artigos com a sua id serão deletados
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
