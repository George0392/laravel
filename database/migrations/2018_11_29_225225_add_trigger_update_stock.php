<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerUpdateStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         DB::unprepared(
            'CREATE TRIGGER tr_update_stock_ingreso AFTER insert ON detalle_ingreso
            FOR EACH ROW
            BEGIN
            UPDATE articulo SET stock = stock + NEW.cantidad
            WHERE articulo.id_articulo = NEW.id_articulo;
            END
            '

         );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER tr_update_stock_ingreso');
    }
}
