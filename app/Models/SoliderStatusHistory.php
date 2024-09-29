<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoliderStatusHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'go_date' => 'date',
        'return_date' => 'date',
    ];
    
    public function solider()
    {
        return $this->belongsTo(Solider::class, 'solider_id')->with(['soliderStatus']);
    }

    
}
