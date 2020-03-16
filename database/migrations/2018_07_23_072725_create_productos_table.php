<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion',255);
            $table->integer('precio');
            $table->string('imagen');
            $table->integer('categoria_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
    }
}
