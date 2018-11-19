<?php

use Faker\Generator as Faker;
use sisven\Ingreso;
use sisven\Articulo;

$factory->define(sisven\Detalle_ingreso::class, function (Faker $faker) {
    return [
    'id_ingreso'   => Ingreso::all()->random()->id_ingreso,
    'id_articulo'  => Articulo::all()->random()->id_articulo,
    'cantidad'     =>$faker->numberBetween(1, 500),
    'precio_compra'=>$faker->numberBetween(1, 500),
    'precio_venta' =>$faker->numberBetween(1, 500),
    ];
});
