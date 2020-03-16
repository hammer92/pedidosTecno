<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdenDetallesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('cantidad');
            $table->integer('precio');
            $table->integer('subtotal');
            $table->integer('orden_id')->unsigned()->default(0);
            $table->integer('producto_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('orden_id')->references('id')->on('ordens');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orden_detalles');
    }
}
