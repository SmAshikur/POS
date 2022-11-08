<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[
            'cash_balance'=>1000,
            'mobile_balance'=>1000,
            'bank_balance'=>1000,
            ];
            Balance::insert($rec);
    }
}
