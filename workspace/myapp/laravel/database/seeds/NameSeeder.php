<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('member_names')->insert([
            'name' => 'initUser',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
