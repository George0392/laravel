<?php

use Faker\Generator as Faker;
use sisven\Categoria;

$factory->define(sisven\Articulo::class, function (Faker $faker) {
    return [
    'id_categoria'=> Categoria::all()->random()->id_categoria,
    'nombre'      => $faker->name,
    'codigo'      => str_random(5),
    'stock'       => Categoria::all()->random()->id_categoria,
    'descripcion' => $faker->text,
    'imagen'      => str_random(5).'.jpg',
    'estado'      => 'Activo',

// campos faker:
// $faker->name,
// $faker->addres,
// $faker->text,
// $faker->unique()->randomDigit,
// $faker->PhoneNumber,
// $faker->DateanTime,
// $faker->File,
// $faker->numberBetween(1,500),


    ];
});
