<?php

use Illuminate\Database\Seeder;
use App\Tester;

class TesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tester::create([
            'name' => 'あああああ',
        ]);
        Tester::create([
            'name' => 'いいいいい',
        ]);
        Tester::create([
            'name' => 'ううううう',
        ]);
        Tester::create([
            'name' => 'おおおおお',
        ]);
    }
}
