<?php

use Illuminate\Database\Seeder;

class NecomataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menders = [
            'necomata','MasahideSaito','TsukasaAdachi','ShoichiKikawa','TakayukiOono','YosukeTakahashi',
            'TakahiroIno','DaisukeOkita','YutaSuzuki','TakehiroMotoyoshi','TakuyaAndoh','YukiIshimoto',
            'TomokoSato','HarukaEsashi','SeiryuSekiguchi','ShingoTakesawa','NatsukiTakahashi','HiromuSato'
        ];

        foreach ($menders as $member) {
            DB::table('member_names')->insert([
                'name' => $member,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
            
        }
    }
}
