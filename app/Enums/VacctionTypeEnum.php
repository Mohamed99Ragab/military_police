<?php


namespace App\Enums;

Class VacctionTypeEnum {

    const Original = 'اسبوعية';
    const Individual = 'فردية';
    const Exception = 'استثنائي';
    const Illness = 'مرضية';


    public  static function VacctionTypes(){

        return [
            self::Original,
            self::Individual,
            self::Exception,
            self::Illness,

        ];
    }


    

}