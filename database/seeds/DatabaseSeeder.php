<?php

use Illuminate\Database\Seeder;
use sisven\User;
use sisven\Categoria;
use sisven\Articulo;
use sisven\Persona;
use sisven\Ingreso;
use sisven\Detalle_ingreso;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(User::class, 100)->create();
        factory(Categoria::class, 90)->create();
        factory(Persona::class, 90)->create();
        factory(Articulo::class, 90)->create();
        factory(Ingreso::class, 90)->create();
        factory(Detalle_ingreso::class, 90)->create();
        $this->call(Usuario::class);
    }
}
