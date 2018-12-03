<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_persona');
            $table->string('tipo_persona', 10);
            $table->string('nombre', 100);
            $table->string('tipo_documento', 20);
            $table->integer('numero_documento')->unsigned();
            $table->string('direccion', 250);
            $table->string('telefono');
            $table->string('email', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
