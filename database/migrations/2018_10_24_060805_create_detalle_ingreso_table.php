<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('iddetalle_ingreso');
            $table->integer('id_ingreso')->unsigned();
            $table->integer('id_articulo')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->decimal('precio_compra',18,2);
            $table->decimal('precio_venta',18,2);
            $table->timestamps();
            $table->foreign('id_articulo')->references('id_articulo')->on('articulo');
            $table->foreign('id_ingreso')->references('id_ingreso')->on('ingreso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ingreso');
    }
}
