<?php


namespace App\Enums;

Class SoliderStatusEnum {

    const Hospital = 'مستشفى';
    const Absence = 'غياب';
    const Fleeing = 'هروب';
    const Prison = 'سجن';
    const CentralPrison ='سجن مركزي';
    const Mission = 'مامؤرية';
    const OriginalVacation = 'اجازة اسبوعية';
    const IndividualVacation = 'اجازة فردية';
    const ExceptionVacation = 'اجازة استثنائي';
    const IllnessVacation = 'اجازة مرضية';


    public  static function statues(){

        return [
            self::Hospital,
            self::Absence,
            self::Fleeing,
            self::Prison,
            self::CentralPrison,
            self::Mission,
            self::OriginalVacation,
            self::IndividualVacation,
            self::ExceptionVacation,
            self::IllnessVacation,


        ];
    }


    

}