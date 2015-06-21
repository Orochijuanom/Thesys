<?php

use DB;
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

        	'name' => 'adminthesys',
        	'email' => 'jcruz02@itfip.edu.co',
        	'password' => bcrypt('AdminThesysSecurePassword')

        	]);
    }
}
