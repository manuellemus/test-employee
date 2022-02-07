<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Empleados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            'nombre' => 'Jose Lozano',
            'correo' => 'jose@yahoo.com',
            'telefono' => '22222222',
            'departamento_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('empleados')->insert([
            'nombre' => 'Carlos Orellana',
            'correo' => 'carlos@yahoo.com',
            'telefono' => '22222222',
            'departamento_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('empleados')->insert([
            'nombre' => 'Pedro Iraheta',
            'correo' => 'pedro@yahoo.com',
            'telefono' => '22222222',
            'departamento_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('empleados')->insert([
            'nombre' => 'Edgar Lainez',
            'correo' => 'edgar@yahoo.com',
            'telefono' => '22222222',
            'departamento_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
