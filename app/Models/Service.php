<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

   

    protected static function boot(){
        parent::boot();

        static::creating(function($service){
            $service->created_by = auth()->id();

        });

        static::updating(function($service){
            $service->updated_by = auth()->id();

        });


    }
    
    public function servicePlaces()
    {
        return $this->hasMany(ServicePlace::class, 'service_place_id');
    }

    public function soliderServices()
    {
        return $this->hasMany(SoliderService::class, 'service_id');
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
