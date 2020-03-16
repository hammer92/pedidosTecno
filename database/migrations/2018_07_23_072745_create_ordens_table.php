<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdensTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->default(0);
            $table->string('direccion');
            $table->enum('estado', ['pendiente','cocina','enviado','cancelado','facturado']);
            $table->integer('total');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ordens');
    }
}
