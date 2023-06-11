<?php

use Illuminate\Database\Seeder;
use App\Testphone;

class TestphoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Testphone::create([
            'tester_id' => '1',
            'favorite_teams' => '["1. FCケルン", "ボルシア・ドルトムント"]',
        ]);
        Testphone::create([
            'tester_id' => '2',
            'favorite_teams' => '["バイエルン", "シャルケ"]',
        ]);
        Testphone::create([
            'tester_id' => '3',
            'favorite_teams' => '["フランクフルト", "psv"]',
        ]);
    }
}
