<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function boot(){
        parent::boot();

        static::creating(function($degree){
            $degree->created_by = auth()->id();

        });

        static::updating(function($degree){
            $degree->updated_by = auth()->id();

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
