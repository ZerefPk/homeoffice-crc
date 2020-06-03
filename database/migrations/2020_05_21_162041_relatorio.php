<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relatorio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('relatorio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('data_referencia');
            $table->boolean('pendencia');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    
        Schema::create('detalhe', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->text('descricao');
            $table->unsignedBigInteger('relatorio_id');
            $table->string('curso');
            $table->timestamps();
            $table->foreign('relatorio_id')->references('id')->on('relatorio');
        });
        Schema::create('anexo', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('detalhe_id');
            $table->string('path');
            $table->timestamps();
            $table->foreign('detalhe_id')->references('id')->on('detalhe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
