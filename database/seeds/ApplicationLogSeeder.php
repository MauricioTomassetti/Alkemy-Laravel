<?php

use App\Log;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logs = Log::create([
            'id_app' => 1,
            'old_price' => 125.37,
            'new_price' => 284.37,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $logs->applications()->sync([1]); // array of applications ids
    }
}
