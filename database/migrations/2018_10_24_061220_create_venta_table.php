<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_venta');
            $table->integer('id_cliente')->unsigned();
            // $table->integer('id_usuario')->unsigned();
            $table->string('tipo_comprobante',50);
            $table->string('serie_comprobante');
            $table->string('num_comprobante');
            $table->date('fecha_hora');
            $table->decimal('impuesto',18,2);
            $table->decimal('total_venta',18,2);
            $table->string('estado');
            $table->timestamps();
            $table->foreign('id_cliente')->references('id_persona')->on('persona');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
