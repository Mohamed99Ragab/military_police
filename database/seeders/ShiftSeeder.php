<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shift;
class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'ليلي',
            'صباحي', 
         ];
 
         foreach($data as $item){
             Shift::updateOrCreate(['name'=>$item],[
                 'name'=>$item,
             ]);
     
         }
    }
}
