<?php

use App\Http\Controllers\ImportSolidersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\EditProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServicePlacesController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\Admin\SoliderController;
use App\Http\Controllers\Admin\SoliderServiceController;
use App\Http\Controllers\Admin\ServiceHistoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SoliderStatusController;
use App\Http\Controllers\Admin\SoliderStatusHistoryController;




use Carbon\Carbon;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'viewLogin'])->name('login')->middleware('guest');

Route::post('/loginPost', [AuthController::class, 'login'])->name('login.post');


Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('places/{serviceId}',[ServicePlacesController::class,'getPlacesByServiceId'])->name('service.places');



    Route::group(['middleware'=>'auth'],function () {

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // edit profile
        Route::group(['controller'=>EditProfileController::class],function(){
            Route::get('/edit-profile', 'index')->name('edit.profile.index');
            Route::post('/update-profile', 'editProfile')->name('edit.profile.update');
        });



        // users
        Route::resource('users', UserController::class);


            Route::prefix('system-management')->group(function () {
                Route::resource('services', ServiceController::class);
                Route::resource('places', ServicePlacesController::class);
                Route::resource('shifts', ShiftController::class);
                Route::resource('degrees', DegreeController::class);

            });

            // soliders
        Route::delete('soliders/bulk-delete', [SoliderController::class, 'bulkDelete'])
            ->name('soliders.bulk-delete');
        Route::resource('soliders', SoliderController::class);

              // service for soliders
              Route::resource('serviceSoliders', SoliderServiceController::class);




            // service history
              Route::get('service-history/{soliderId?}', [ServiceHistoryController::class,'index'])->name('service.history.index');
              Route::delete('service-history/{soliderId}', [ServiceHistoryController::class,'destroy'])->name('service.history.delete');


              // reports
              Route::controller(ReportController::class)->group(function () {
                  Route::get('/reports/soliders', 'soliderReportView')->name('reports.solider.index');
                  Route::get('/reports/vacations', 'vacationReportView')->name('reports.vacation.index');

                  Route::get('/reports/solider/send', 'SoliderReport')->name('reports.solider');
                  Route::post('/reports/vacation', 'vacationReport')->name('reports.vacation');


                  Route::get('/reports/daily', 'showDailyReport')->name('reports.daily');

              });

              Route::get('/reports/soliders/{status}',[HomeController::class,'getSolidersByStatus'])->name('reports.soliders.status');


                // حالات الجنود
                Route::get('soliderStatues/history/{soliderId}',[SoliderStatusHistoryController::class,'index'])->name('soliderStatues.history');
                Route::resource('soliderStatues', SoliderStatusController::class);

                // import and export soliders by excel
           Route::post('soliders/import',[ImportSolidersController::class,'import'])
               ->name('soliders.import');

            Route::get('/full-export/soliders',[ImportSolidersController::class,'export'])
                ->name('soliders.export');


    });

});


Route::get('test', function () {

    $return_date = Carbon::parse('2024-08-07');

    // return $return_date;
    if($return_date->gte(Carbon::now()->format('Y-m-d'))){
            echo 'لائق';
    }else{
        echo 'غير لائق';

    }
});




Route::get('/test',function(){

    // SoliderService::




});
