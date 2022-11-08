<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[

            'name'=>'Bits-I Tech solution',
            'location'=>'savar'
            ];
            Setting::insert($rec);
    }
}
