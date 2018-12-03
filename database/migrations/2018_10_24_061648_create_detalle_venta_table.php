<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('iddetalle_venta');
            $table->integer('id_venta')->unsigned();
            $table->integer('id_articulo')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->decimal('precio_venta',18,2);
            $table->decimal('descuento',18,2);
            $table->timestamps();
            $table->foreign('id_venta')->references('id_venta')->on('venta');
            $table->foreign('id_articulo')->references('id_articulo')->on('articulo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}
