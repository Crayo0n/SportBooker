<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplejoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complejos_tabla')->insert([
            [
                'admin_user_id' => '1',
                'nombre' => 'Complejo Deportivo Central.',
                'direccion' => 'Queretaro, Queretaro',
                'numero_contacto' => '4420000000',
                'imagen_url' => '',
                'descricion' => '',
                'status' => '',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}
