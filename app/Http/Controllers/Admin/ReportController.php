<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solider;
use App\Models\Degree;
use App\Models\Service;

use App\Models\Vacation;

use App\Enums\SoliderStatusEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{


    public function soliderReportView() {

        $this->authorize('view-solider-report');

        $degrees = Degree::get();
        $services = Service::get();


        return view('admin.reports.soliders-report',compact('degrees','services'));

    }




    public function SoliderReport(Request $request){
        $today = Carbon::today();

        // return $request;
        $requestData = $request;


        $query = Solider::query()->with(['createdBy','updatedBy','degree','soliderStatus','soliderService.service']);
        if($request->name){
            $query->where('full_name','like','%'.$request->name.'%');
        }

        if($request->military_number){
            $query->where('military_number',$request->military_number);
        }

        if($request->degree_id){
            $query->where('degree_id',$request->degree_id);
        }

        if($request->phone_number){
            $query->where('phone_number',$request->phone_number);
        }

        if($request->address){
            $query->where('address','like','%'.$request->address.'%');
        }

        if($request->service_id){
            $query->whereHas('soliderService',function($query) use ($request){
                $query->where('service_id',$request->service_id);
            });
        }

        if($request->status && $request->status == 'موجود'){
            $query->whereDoesntHave('soliderStatus')
            ->orWhereHas('soliderStatus',function($query) use ($today){
                $query->where('return_date','=',$today)
                ->orWhere(function($query) use ($today){
                    $query->where('go_date','>',$today)
                    ->orWhere('return_date','<',$today);
                });
            });
        }

        if($request->status && in_array($request->status,SoliderStatusEnum::statues())){
            $query->whereHas('soliderStatus',function($query) use ($request, $today){
                $query->where(function($query) use ($request, $today) {
                    $query->where('go_date','<=',$today)
                    ->where('return_date','>', $today);
                })->where('status',$request->status);
            });
        }


        if($request->status && $request->status == 'خارج'){
            $query->whereHas('soliderStatus',function($query) use ($request, $today){
                $query->where(function($query) use ($request, $today) {
                    $query->where('go_date','<=',$today)
                    ->where('return_date','>', $today);
                });
            });
        }


        if($request->go_date){
            $query->whereHas('soliderStatus',function($query) use ($request){
                $query->where('go_date', $request->go_date);
            });
        }

        if($request->return_date){
            $query->whereHas('soliderStatus',function($query) use ($request){
                $query->where('return_date', $request->return_date);
            });
        }

        if($request->return_date && $request->go_date){

            $query->whereHas('soliderStatus',function($query) use ($request){
                $query->whereBetween('go_date',[$request->go_date,$request->return_date]);
            });

        }







        $soliders = $query->get();
        $degrees = Degree::get();
        $services = Service::get();





        return view('admin.reports.soliders-report',compact('soliders','requestData','degrees','services'));
    }




    public function showDailyReport()
    {



        $today = Carbon::today()->toDateString();

        $services = DB::table('services')
            ->leftJoin('solider_services', 'services.id', '=', 'solider_services.service_id')
            ->leftJoin('soliders', 'solider_services.solider_id', '=', 'soliders.id')
            ->leftJoin('solider_statuses', 'soliders.id', '=', 'solider_statuses.solider_id')

            ->select(
                'services.name',
                DB::raw('COUNT(solider_services.id) as total'),
                DB::raw('SUM(CASE WHEN soliders.id IS NOT NULL AND (solider_statuses.id IS NULL OR solider_statuses.return_date <= "' . $today . '") THEN 1 ELSE 0 END) as present'),
                DB::raw("SUM(CASE WHEN (solider_statuses.status IN ('" . SoliderStatusEnum::OriginalVacation . "', '" . SoliderStatusEnum::IndividualVacation . "', '" . SoliderStatusEnum::ExceptionVacation . "', '" . SoliderStatusEnum::IllnessVacation . "') AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as onVacation"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::Mission . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as onMission"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::Absence . "' AND (solider_statuses.return_date IS NULL OR solider_statuses.return_date > '$today')) THEN 1 ELSE 0 END) as absentStatus"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::Fleeing . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as inEscaped"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::Prison . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as inJail"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::CentralPrison . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as inCentralJail"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::Hospital . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as inHospital"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status = '" . SoliderStatusEnum::IllnessVacation . "' AND solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today') THEN 1 ELSE 0 END) as onIllnessVacation"),
                DB::raw("SUM(CASE WHEN (solider_statuses.status IS NOT NULL AND (solider_statuses.return_date > '$today' OR (solider_statuses.go_date <= '$today' AND solider_statuses.return_date > '$today'))) THEN 1 ELSE 0 END) as notPresent")
            )
            ->groupBy('services.name')
            ->get();


        // جمع الإجماليات
        $totals = [
            'totalSoliders' => $services->sum('total'),
            'totalPresent' => $services->sum('present'),
            'totalOnVacation' => $services->sum('onVacation'),
            'totalOnMission' => $services->sum('onMission'),
            'totalAbsentStatus' => $services->sum('absentStatus'),
            'totalInJail' => $services->sum('inJail'),
            'totalInCentralJail' => $services->sum('inCentralJail'),
            'totalEscaped' => $services->sum('inEscaped'),
            'totalInHospital' => $services->sum('inHospital'),
            'totalIllnessVacation' => $services->sum('onIllnessVacation'),
            'totalNotPresent' => $services->sum('notPresent'),
        ];

        return view('admin.reports.daily-report', compact('services', 'totals'));
    }



      public function showDailyReportOld()
    {
        $report = Service::with(['soliderServices.solider.soliderStatus'])->get();

        $data = [];

        $today = Carbon::today();

        // Initialize totals
        $totalSoliders = 0;
        $totalPresent = 0;
        $totalNotPresent = 0;
        $totalOnVacation = 0;
        $totalOnMission = 0;
        $totalAbsentStatus = 0;
        $totalInJail = 0;
        $totalInCentralJail = 0;
        $totalEscaped = 0;
        $totalInHospital = 0;
        $totalIllnessVacation = 0;

        foreach ($report as $service) {
            $total = $service->soliderServices->count();

            $present = 0;
            $notPresent = 0;
            $onVacation = 0;
            $onMission = 0;
            $absentStatus = 0;
            $inJail = 0;
            $inCentralJail = 0;
            $escaped = 0;
            $inHospital = 0;
            $onIllnessVacation = 0;

            foreach ($service->soliderServices as $soliderService) {
                $solider = $soliderService->solider;
                $status = $solider->soliderStatus;

                if ($status) {
                    if ($status->status === SoliderStatusEnum::Absence || $status->status === SoliderStatusEnum::Fleeing) {
                        // التعامل مع حالات الغياب أو الهروب
                        if ($status->return_date === null || $status->return_date > $today) {
                            if ($status->status === SoliderStatusEnum::Absence) {
                                $absentStatus++;
                            } else {
                                $escaped++;
                            }
                            // إضافة حالات الغياب والهروب إلى إجمالي الغير موجودين
                            $notPresent++;
                        } else {
                            $present++;
                        }
                    } elseif ($status->return_date <= $today) {
                        $present++;
                    } else {
                        switch ($status->status) {
                            case SoliderStatusEnum::IllnessVacation:
                                // الجندي في اجازة مرضية
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $onIllnessVacation++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            case SoliderStatusEnum::OriginalVacation:
                            case SoliderStatusEnum::ExceptionVacation:
                            case SoliderStatusEnum::IndividualVacation:
                                // الجندي في إجازة
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $onVacation++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            case SoliderStatusEnum::Mission:
                                // الجندي في مأمورية
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $onMission++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            case SoliderStatusEnum::Prison:
                                // الجندي في حبس
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $inJail++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            case SoliderStatusEnum::CentralPrison:
                                // الجندي في حبس مركزي
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $inCentralJail++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            case SoliderStatusEnum::Hospital:
                                // الجندي في مستشفى
                                if ($status->go_date <= $today && $status->return_date > $today) {
                                    $inHospital++;
                                    $notPresent++;
                                } else {
                                    $present++;
                                }
                                break;

                            default:
                                $present++;
                                break;
                        }
                    }
                } else {
                    $present++;
                }
            }

            // Update the totals
            $totalSoliders += $total;
            $totalPresent += $present;

            $totalOnVacation += $onVacation;
            $totalOnMission += $onMission;
            $totalAbsentStatus += $absentStatus;
            $totalInJail += $inJail;
            $totalInCentralJail += $inCentralJail;
            $totalEscaped += $escaped;
            $totalInHospital += $inHospital;
            $totalIllnessVacation += $onIllnessVacation;

            $totalNotPresent += $notPresent;

            $data[] = [
                'service' => $service->name,
                'total' => $total,
                'present' => $present,
                'onVacation' => $onVacation,
                'onMission' => $onMission,
                'absentStatus' => $absentStatus,
                'inJail' => $inJail,
                'inCentralJail' => $inCentralJail,
                'escaped' => $escaped,
                'inHospital' => $inHospital,
                'onIllnessVacation' => $onIllnessVacation,
                'notPresent' => $notPresent,
            ];
        }

        // Pass the totals to the view
        $totals = [
            'totalSoliders' => $totalSoliders,
            'totalPresent' => $totalPresent,
            'totalOnVacation' => $totalOnVacation,
            'totalOnMission' => $totalOnMission,
            'totalAbsentStatus' => $totalAbsentStatus,
            'totalInJail' => $totalInJail,
            'totalInCentralJail' => $totalInCentralJail,
            'totalEscaped' => $totalEscaped,
            'totalInHospital' => $totalInHospital,
            'totalIllnessVacation' => $totalIllnessVacation,
            'totalNotPresent' => $totalNotPresent,
        ];

        return view('admin.reports.daily-report-old', compact('data', 'totals'));
    }

    






}
