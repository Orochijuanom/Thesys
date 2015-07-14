<?php


use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

        	'username' => 'JCRUZ02',
        	

        	]);

        DB::table('users')->insert([

            'username' => 'RDIAZ13',
            

        ]);
    }
}
