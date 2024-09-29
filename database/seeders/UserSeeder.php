<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\RoleEnum;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        User::updateOrCreate(['username'=>'admin'],[
            'username'=>'admin',
            'password'=>Hash::make('123456'),
            'role'=>RoleEnum::Admin
        ]);


        User::updateOrCreate(['username'=>'solider'],[
            'username'=>'solider',
            'password'=>Hash::make('123456'),
            'role'=>RoleEnum::Solider
        ]);


        User::updateOrCreate(['username'=>'officer class'],[
            'username'=>'officer class',
            'password'=>Hash::make('123456'),
            'role'=>RoleEnum::OfficerClass
        ]);



    }
}
