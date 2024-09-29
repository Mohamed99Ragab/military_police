<?php

namespace App\Imports;

use App\Models\Degree;
use App\Models\Solider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SolidersImport implements ToModel,WithHeadingRow ,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
       $degree = Degree::firstOrCreate(['name'=>'جندي']);

        return new Solider([
            'full_name' => $row['alasm'],
            'address' => $row['alaanoan'],
            'phone_number' => $row['rkm_altlyfon'],
            'military_number'=>$row['alrkm_alaaskr'],
            'degree_id'=>$degree->id

        ]);
    }

    public function rules(): array
    {
        return [
            'alasm'=>'required|string|min:15',
            'alaanoan'=>'required',
            'rkm_altlyfon'=>'required|unique:soliders,phone_number|min:11|max:11',
            'alrkm_alaaskr'=>'required|unique:soliders,military_number|min:13|max:13',

        ];
    }


    public function chunkSize(): int
    {
        return 100;
    }
}
