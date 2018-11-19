<?php

use Faker\Generator as Faker;

$factory->define(sisven\Persona::class, function (Faker $faker) {
    return [
        'tipo_persona'     =>'proveedor',
        'nombre'           =>$faker->name,
         'tipo_documento'  =>'V',
         'numero_documento'=>$faker->numberBetween(1, 500),
         'direccion'       =>$faker->address,
         'telefono'        =>$faker->PhoneNumber,
         'email'           =>$faker->unique()->safeEmail,
    ];
});
