<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$roles = [
			[ 'role'=>'Super Admin'],
			[ 'role'=>'Dokter'],
			[ 'role'=>'Admin'],
			[ 'role'=>'Perawat'],
			[ 'role'=>'Bidan'],
			[ 'role'=>'Apoteker'],
			[ 'role'=>'Asisten Apoteker']
		];
		App\Role::insert($roles);
    }
}
