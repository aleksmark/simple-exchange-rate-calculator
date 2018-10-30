<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exchanges')->delete();
        DB::table('currencies')->delete();

        DB::table('currencies')->insert(['name' => 'EUR']);
        DB::table('currencies')->insert(['name' => 'USD']);
        DB::table('currencies')->insert(['name' => 'TRY']);
        DB::table('currencies')->insert(['name' => 'GBP']);
    }
}
