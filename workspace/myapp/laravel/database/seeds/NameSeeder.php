<?php

use Illuminate\Database\Seeder;
use App\Member;

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
        Member::create([
            'name' => '山田　太郎'
        ]);

        Member::create([
            'name' => '山田　二郎'
        ]);

        Member::create([
            'name' => '山田　三郎'
        ]);
    }
}
