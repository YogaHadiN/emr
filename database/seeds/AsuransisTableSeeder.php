<?php

use Illuminate\Database\Seeder;
use App\Asuransi;

class AsuransisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement("insert into `asuransis` (`nama_asuransi`, `user_id`, `updated_at`, `created_at`) values ('Biaya Pribadi', '1', '2019-04-14 13:45:56', '2019-04-14 13:45:56')");
    }
}
