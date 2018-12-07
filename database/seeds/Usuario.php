<?php

use Illuminate\Database\Seeder;

class Usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('users')->truncate();

            DB::table('users')->insert([
            'name'     => 'Admin',
            'email'    => '123@123.com',
            'password' => bcrypt(123),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
