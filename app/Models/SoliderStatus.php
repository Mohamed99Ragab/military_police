<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoliderStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'go_date' => 'date',
        'return_date' => 'date',
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->created_by = auth()->id();

        });

        static::updating(function($model){
            $model->updated_by = auth()->id();

        });


    }




    public function solider()
    {
        return $this->belongsTo(Solider::class, 'solider_id')->with(['degree']);
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
