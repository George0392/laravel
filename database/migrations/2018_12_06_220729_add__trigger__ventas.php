<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared(
            'CREATE TRIGGER trigger_update_stock_ventas AFTER insert ON detalle_venta
            FOR EACH ROW
            BEGIN
            UPDATE articulo SET stock = stock - NEW.cantidad
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
        DB::unprepared('DROP TRIGGER trigger_update_stock_ventas');
    }
}
