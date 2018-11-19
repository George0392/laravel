<?php

use Faker\Generator as Faker;

$factory->define(sisven\Categoria::class, function (Faker $faker) {
    return [
    'nombre'     =>$faker->name,
    'descripcion'=>$faker->text,
    'condicion'  =>'1',

    ];
});
