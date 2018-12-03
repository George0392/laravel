<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_articulo');
            $table->integer('id_categoria')->unsigned();
            $table->string('nombre', 100);
            $table->string('codigo', 100);
            $table->integer('stock');
            $table->string('descripcion', 250);
            $table->string('imagen');
            $table->string('estado', 20);
            $table->timestamps();
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo');
    }
}
