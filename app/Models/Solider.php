<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Solider extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::creating(function($solider){
            $solider->created_by = auth()->id();

        });

        static::updating(function($solider){
            $solider->updated_by = auth()->id();

        });


    }



    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }



    public function history()
    {
        return $this->hasMany(SoliderServiceHistory::class, 'solider_id');
    }

    public function soliderService()
    {
        return $this->hasOne(soliderService::class, 'solider_id')->with(['service','servicePlace','degree','shift']);
    }





    public function soliderStatus()
    {
        return $this->hasOne(SoliderStatus::class, 'solider_id');
    }





    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    public function scopeFilter($query ,Request $request){

      return  $query->when($request->name,function($query, $request){
            $query->where('full_name','like','%'.$request->name.'%');
        })
        ->$query->when($request->military_number,function($query, $request){
            $query->where('military_number',$request->military_number);
        })
        ->$query->when($request->degree_id,function($query, $request){
            $query->where('degree_id',$request->degree_id);
        })
        ->$query->when($request->phone_number,function($query, $request){
            $query->where('phone_number',$request->phone_number);
        })
        ->$query->when($request->address,function($query, $request){
            $query->where('address','like','%'.$request->address.'%');
        });

    }

}
