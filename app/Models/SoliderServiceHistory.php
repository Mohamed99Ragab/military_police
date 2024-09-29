<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoliderServiceHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'assign_date'=>'date'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function servicePlace()
    {
        return $this->belongsTo(ServicePlace::class, 'service_place_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }


    public function solider()
    {
        return $this->belongsTo(Solider::class, 'solider_id')->with(['soliderStatus']);
    }
}
