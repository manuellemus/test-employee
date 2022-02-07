<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Departamentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            'nombreDepartamento' => 'Desarrollo',
            'ubicacion' => 'UTIT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('departamentos')->insert([
            'nombreDepartamento' => 'Soporte',
            'ubicacion' => 'Heldesk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('departamentos')->insert([
            'nombreDepartamento' => 'Diseño Web',
            'ubicacion' => 'UTIT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
