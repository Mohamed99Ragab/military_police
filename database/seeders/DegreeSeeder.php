<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $data = [
            'جندي',
            'صف ظابط',
            'مساعد',
            'مساعد اول',
            'رقيب',
            'رقيب اول'
        ];

        foreach($data as $item){
            Degree::updateOrCreate(['name'=>$item],[
                'name'=>$item,
            ]);
    
        }
      


    }
}
