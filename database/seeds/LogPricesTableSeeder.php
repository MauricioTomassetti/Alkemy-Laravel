<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class LogPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('log_prices')->insert([
            'id_app' => 1,
            'old_price' => 125.37,
            'new_price' => 284.37,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('log_prices')->insert([
            'id_app' => 2,
            'old_price' => 100.37,
            'new_price' => 300.37,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('log_prices')->insert([
            'id_app' => 3,
            'old_price' => 110.37,
            'new_price' => 380.37,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
 
    }
}
