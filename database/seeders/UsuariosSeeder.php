<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complejo = DB::table('complejos_tabla')->first();
        $idComplejo = $complejo ? $complejo->id : null;

        // Contraseña igual para todos para no batallar: "12345678"
        $passwordComun = Hash::make('12345678');

        $usuarios = [
            // --- 1. SUPER ADMIN ---
            [
                'role_id'     => 1, 
                'nombre'      => 'Super',
                'apellido'    => 'Admin',
                'email'       => 'super@admin.com',
                'password'    => $passwordComun,
                'phone_number'    => '0000000000',
                'curp'        => null,
                'status'      => 'Aprobado',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // --- 2. ADMIN DE CANCHA (Gerente) ---
            [
                'role_id'     => 2, 
                'nombre'      => 'Gerente',
                'apellido'    => 'Deportivo',
                'email'       => 'admin@complejo.com',
                'password'    => $passwordComun,
                'phone_number'    => '4421112233',
                'curp'        => null,
                'status'      => 'Aprobado',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // --- 3. CLIENTE OCASIONAL (Juan Pérez) ---
            [
                'role_id'     => 3, 
                'nombre'      => 'Juan',
                'apellido'    => 'Pérez',
                'email'       => 'cliente@test.com',
                'password'    => $passwordComun,
                'phone_number'    => '4429998877',
                'curp'        => null,
                'status'      => 'Aprobado',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // --- 4. CLIENTE RECURRENTE (Equipo) ---
            [
                'role_id'     => 4, 
                'nombre'      => 'Capitán',
                'apellido'    => 'Equipo',
                'email'       => 'equipo@test.com',
                'password'    => $passwordComun,
                'phone_number'    => '4425556677',
                'curp'        => 'TEST010101HDFRXX01', 
                'status'      => 'Aprobado',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

             // --- 5. USUARIO PENDIENTE (Para probar bloqueo) ---
             [
                'role_id'     => 3, 
                'nombre'      => 'Usuario',
                'apellido'    => 'Nuevo',
                'email'       => 'pendiente@test.com',
                'password'    => $passwordComun,
                'phone_number'    => '5550000000',
                'curp'        => null,
                'status'      => 'PendienteVerificacion',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($usuarios);
    }
}
