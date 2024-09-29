<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
           'بوابات',
           'ابراج',
           'كلاسترات',

        ];

        foreach($data as $item){
            Service::updateOrCreate(['name'=>$item],[
                'name'=>$item,
            ]);
    
        }

        
      
    }
}
