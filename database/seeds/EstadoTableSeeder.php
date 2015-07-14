<?php


use Illuminate\Database\Seeder;


class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(['estado' => 'Propuesta','descripcion' => 'Propuesta de grado enviada por los estudiantes pendiente de aprovación']);

        DB::table('estados')->insert(['estado' => 'Aceptada','descripcion' => 'Tema de trabajo de grado aceptado para su desarrollo']);

        DB::table('estados')->insert(['estado' => 'Rechazada','descripcion' => 'Tema de trabajo de grado no aceptado para su desarrollo']);

        DB::table('estados')->insert(['estado' => 'Abandonada','descripcion' => 'Tema de trabajo de grado abandonado o no terminado dentro del plazo establecido']);

        DB::table('estados')->insert(['estado' => 'Reprobada','descripcion' => 'Tema de trabajo de grado que no cumplió con los requisitos para ser aprovado']);

        DB::table('estados')->insert(['estado' => 'Terminada','descripcion' => 'Tema de trabajo de grado que fue terminado y aprovado por los jurados']);
    }
}
