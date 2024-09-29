<?php

namespace App\Exports;

use App\Models\Solider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolidersExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {



      return  Solider::with(['degree','soliderStatus','soliderService.service'])
        ->get()->map(function ($solider) {
              $today = Carbon::today();
              $goDate = $solider->soliderStatus?->go_date ? Carbon::parse($solider->soliderStatus->go_date) : null;
              $returnDate = $solider->soliderStatus?->return_date ? Carbon::parse($solider->soliderStatus->return_date) : null;

              $presenceStatus = 'موجود';
              if ($goDate && $returnDate) {
                  if ($today->eq($returnDate)) {
                      $presenceStatus = 'موجود';
                  } elseif ($today->between($goDate, $returnDate) || $today->eq($goDate)) {
                      $presenceStatus = 'غير موجود';
                  }
              }
              return [
            'full_name' => $solider->full_name,
            'address' => $solider->address,
            'military_number' => $solider->military_number,
            'phone_number' => $solider->phone_number,
            'degree' => $solider->degree->name,
            'service' => $solider->soliderService?->service?->name ?? '',
            'service_location' => $solider->soliderService?->servicePlace?->name ?? '',
            'shift' => $solider->soliderService?->shift?->name,
              'status' => $solider->soliderStatus?->status ?? '',
              'go_date' => $goDate ? $goDate->format('d/m/Y') : '',
              'return_date' => $returnDate ? $returnDate->format('d/m/Y') : '',
              'presence_status' => $presenceStatus,
        ];
    });

    }

    public function headings(): array
    {

      return  [
            'الاســــم',
            'العنـــوان',
            'الرقم العسكرى',
            'رقم التليفون',
            'الدرجـــة',
            'نوع الخدمة',
            'مكان الخدمة',
            'الشيفت',
            'الحالة',
            'معاد الذهاب',
            'معاد العودة',
            'حالة التواجد',
        ];

    }
}
