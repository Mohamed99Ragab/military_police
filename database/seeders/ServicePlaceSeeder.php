<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ServicePlace;


class ServicePlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
           [
            'name'=>'شمالية',
            'service_id'=>'1'
           ],
           [
            'name'=>'جنوبية',
            'service_id'=>'1'
           ],
           [
            'name'=>'وسطى',
            'service_id'=>'1'
           ],
 
         ];
 
         foreach($data as $item){
            ServicePlace::updateOrCreate(['name'=>$item['name']],[
                 'service_id'=>$item['service_id'],
             ]);
     
         }

        //  DB::statement('ALTER TABLE service_places AUTO_INCREMENT=1');
    }
}
