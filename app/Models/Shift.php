<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function boot(){
        parent::boot();

        static::creating(function($shift){
            $shift->created_by = auth()->id();

        });

        static::updating(function($shift){
            $shift->updated_by = auth()->id();

        });


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
