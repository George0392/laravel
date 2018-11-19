<?php

use Faker\Generator as Faker;
use sisven\Persona;

$factory->define(sisven\Ingreso::class, function (Faker $faker) {
    return [
    'id_proveedor'    => Persona::all()->random()->id_persona,
    'tipo_comprobante'=>'factura',
    'serie_comprobante'=>'J',
    'num_comprobante' =>$faker->numberBetween(1, 500),
    'fecha_hora'      =>'2018-11-11 21:34:27',
    'impuesto'        =>'16',
    'estado'          =>'Activo',


    ];
});
