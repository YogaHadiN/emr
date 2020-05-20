<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user                    = new User;
		$user->name              = 'Klinik Jati Elok';
		$user->alamat              = 'Komplek Bumi Jati Elok Blok A I No. 7, Jl. Raya Legok - Parung Panjang km. 3, Malangnengah, Pagedangan, Tangerang, Banten';
		$user->no_telp              = '081381912803';
		$user->email             = 'yoga_email@yahoo.com';
		$user->email_verified_at = '2019-04-16 12:15:04';
		$user->password          = bcrypt('Yogaman89');
		$user->save();
    }
}
