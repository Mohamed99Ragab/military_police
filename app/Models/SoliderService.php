<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoliderService extends Model
{
    use HasFactory;


    protected $guarded = [];


    protected static function boot(){
        parent::boot();

        static::creating(function($record){
            $record->created_by = auth()->id();

        });

        static::updating(function($record){
            $record->updated_by = auth()->id();

        });


    }


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
        return $this->belongsTo(Solider::class, 'solider_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


}
