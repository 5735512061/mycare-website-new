<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Service;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function serviceCarList(Request $request, $id) {
        $serialnumber = Member::where('id',$id)->value('serialnumber');
        $cars = Member::where('serialnumber',$serialnumber)
                      ->whereNotNull('carnumber')
                      ->get();
        return view('frontend/member/service/car-list')->with('cars',$cars);
    }

    public function serviceHistory(Request $request, $id) {
        
        $NUM_PAGE = 10;
        $car = Member::findOrFail($id);
        $cars = Member::where('id',$car->id)->get();

        $services = Service::where('member_id',$car->id)
                           ->groupBy('date')
                           ->orderBy('id','asc')->get();

        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/service/history')->with('NUM_PAGE',$NUM_PAGE)
                                                      ->with('page',$page)
                                                      ->with('cars',$cars)
                                                      ->with('services',$services);
    }

    public function serviceInformation(Request $request, $id) {
        $NUM_PAGE = 10;
        $service = Service::findOrFail($id);
        $services = Service::where('member_id',$service->member_id)
                           ->where('date',$service->date)
                           ->orderBy('id','asc')->get();
        $service_date = Service::where('member_id',$service->member_id)
                               ->where('date',$service->date)
                               ->orderBy('id','asc')->value('date');
        $service_mile = Service::where('member_id',$service->member_id)
                               ->where('date',$service->date)
                               ->orderBy('id','asc')->value('miles');
        $service_branch = Service::where('member_id',$service->member_id)
                                 ->where('date',$service->date)
                                 ->orderBy('id','asc')->value('branch');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/service/information')->with('NUM_PAGE',$NUM_PAGE)
                                                          ->with('page',$page)
                                                          ->with('services',$services)
                                                          ->with('service_date',$service_date)
                                                          ->with('service_mile',$service_mile)
                                                          ->with('service_branch',$service_branch);
    }
}
