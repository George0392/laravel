<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ingreso');
            $table->integer('id_proveedor')->unsigned();
            $table->string('tipo_comprobante', 50);
            $table->string('serie_comprobante', 2);
            $table->integer('num_comprobante')->unsigned();
            $table->datetime('fecha_hora');
            $table->decimal('impuesto', 18, 2);
            $table->string('estado', 20);
            $table->timestamps();
            $table->foreign('id_proveedor')->references('id_persona')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso');
    }
}
