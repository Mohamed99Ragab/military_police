<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SoliderStatusHistory;

class SoliderStatusHistoryController extends Controller
{
    

    public function index($soliderId){

        $SoliderStatues = SoliderStatusHistory::with('solider')
        ->whereSoliderId($soliderId)
        ->orderBy('return_date','desc')
        ->get();

        return view('admin.solider-statues.history',compact('SoliderStatues'));


    }
}
