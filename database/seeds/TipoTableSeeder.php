<?php


use Illuminate\Database\Seeder;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert(
            [
                'tipo' => 'Pasantia',	 
                'descripcion' => 'Ejercicio aplicativo que exige la presencia regula en una empresa u organizacion'
            ]);

        DB::table('tipos')->insert(
            [
                'tipo' => 'Práctica Supervisada',
                'descripcion' => 'Aplicación a una realidad concreta que no requiere la presencia permante del practicante en la empresa o comunidad'
            ]);

        DB::table('tipos')->insert(
            [
                'tipo' => 'Proyecto de Investigación',
                'descripcion' => 'Acción de generación, convalidación y aplicación de conocimientos en los niveles y metodologias que correspondan'
            ]);

        DB::table('tipos')->insert(
            [
                'tipo' => 'Monografía',
                'descripcion' => 'Constituye una actividad investigativa que se caractriza por un alto componente teórico que recopila lo logrado en investigaciones existentes'
            ]);
    }
}
