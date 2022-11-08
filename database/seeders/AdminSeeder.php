<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[
            [
            'name'=>'S M Ashikur Rahman',
            'role'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('12345678'),
            ],
            [
            'name'=>'S M Ashikur',
            'role'=>'admin',
            'email'=>'admin1@gmail.com',
            'password'=>bcrypt('12345678'),
            ]
            ];
             User::insert($rec);
    }
}
