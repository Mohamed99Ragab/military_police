<?php

namespace App\Http\Controllers;

use App\Exports\SolidersExport;
use App\Http\Requests\ImportFileRequest;
use App\Imports\SolidersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportSolidersController extends Controller
{

    public function import(ImportFileRequest $request)
    {
        try{

            Excel::import(new SolidersImport(), $request->file('file'));
            notify()->success('تم استيراد بيانات الجنود بنجاح','عملية ناجحة');

            return redirect()->back();

        }catch(\Exception $ex){
            Log::info($ex);
            notify()->error('حدث خطاء ما يرجى المحاولة مرة اخرى','فشل');
            return back();

        }
    }


    public function export()
    {

        return  Excel::download(new SolidersExport(), 'تقارير-بيانات-الجنود.xlsx');

    }

}
