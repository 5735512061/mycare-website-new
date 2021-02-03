<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Salesmember;
use App\Salesservice;
use App\Salescar;

class ServiceSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sales_members');
    }

    public function serviceCarList(Request $request, $id) {
        $id = Salesmember::where('id',$id)->value('id');
        $cars = Salescar::where('member_id',$id)->get();
        return view('frontend/member/service-sales/car-list')->with('cars',$cars);
    }

    public function serviceHistory(Request $request, $id) {
        $NUM_PAGE = 10;
        $car = Salescar::findOrFail($id);
        $cars = Salescar::where('id',$car->id)->get();

        $services = Salesservice::where('car_id',$car->id)
                                ->groupBy('date')
                                ->orderBy('id','asc')->get();

        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/service-sales/history')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('cars',$cars)
                                                            ->with('services',$services);
    }

    public function serviceInformation(Request $request, $id) {
        $NUM_PAGE = 10;
        $service = Salesservice::findOrFail($id);
        $services = Salesservice::where('car_id',$service->car_id)
                                ->where('date',$service->date)
                                ->orderBy('id','asc')->get();
        $service_date = Salesservice::where('car_id',$service->car_id)
                                    ->where('date',$service->date)
                                    ->orderBy('id','asc')->value('date');
        $service_branch = Salesservice::where('car_id',$service->car_id)
                                      ->where('date',$service->date)
                                      ->orderBy('id','asc')->value('branch');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/service-sales/information')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('services',$services)
                                                                ->with('service_date',$service_date)
                                                                ->with('service_branch',$service_branch);
    }
}
