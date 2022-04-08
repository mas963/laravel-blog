<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("configs")->insert([
            "title"=>"yasar can",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
