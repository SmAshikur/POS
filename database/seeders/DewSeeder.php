<?php

namespace Database\Seeders;

use App\Models\Dew;
use Illuminate\Database\Seeder;

class DewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[

            'dew_type'=>'cash',
            'user_id'=>1,
            'reciver_id'=>0,
            'dew_type'=>'return',
            'transication_id'=>0,
            'amount'=>0,

            ];
            Dew::insert($rec);
    }
}
