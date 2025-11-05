<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles_tabla')->insert([
            [
                'nombre' => 'SuperAdmin',
                'descripcion' => 'Control total de la plataforma.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'AdminCancha',
                'descripcion' => 'Administrador de un complejo deportivo.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'ClienteOcasional',
                'descripcion' => 'Cliente verificado para reservas puntuales.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'ClienteRecurrente',
                'descripcion' => 'Representante de equipo verificado para abonos.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
