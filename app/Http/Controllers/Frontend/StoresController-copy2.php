<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;
use App\Statistic;
use App\Member;
use App\Service;
use App\Condition;

use Carbon\Carbon;
use Auth;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function index(Request $request, $store_name){
        $serialnumber = Auth::guard('member')->user()->serialnumber;
        $store = Store::where('store_name',$store_name)->first();
    	$store_name = $store_name;
        $month_now = Carbon::now()->format('m');
        $year_now = Carbon::now()->format('Y'); 
        $now_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$month_now)
                                  ->whereYear('created_at',$year_now)->count();
        $previous_month = Carbon::now()->subMonth()->format('m');
        $previous_year = Carbon::now()->subYear()->format('Y');
        $previousmonth_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$previous_month)
                                  ->whereYear('created_at',$previous_year)->count();
        $total_statistic = Statistic::where('store_id',$store->id)->count();
    	return view('/frontend/member/privilege/store')->with('store',$store)
    										           ->with('store_name',$store_name)
                                                       ->with('total_statistic',$total_statistic)
                                                       ->with('now_statistic',$now_statistic)
                                                       ->with('previousmonth_statistic',$previousmonth_statistic)
                                                       ->with('serialnumber',$serialnumber);
    }

    public function alliance_privilege(Request $request, $store_name) {
        $store = Store::where('store_name',$store_name)->first();
    	$store_name = $store_name;
        $month_now = Carbon::now()->format('m');
        $now_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$month_now)->count();
        $previous_month = Carbon::now()->subMonth()->format('m');
        $previousmonth_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$previous_month)->count();
        $total_statistic = Statistic::where('store_id',$store->id)->count();
    	return view('/frontend/member/privilege/index')->with('store',$store)
    										           ->with('store_name',$store_name)
                                                       ->with('total_statistic',$total_statistic)
                                                       ->with('now_statistic',$now_statistic)
                                                       ->with('previousmonth_statistic',$previousmonth_statistic);
    }

    public function privilege_receive(Request $request) {
    	$serialnumber = $request->serialnumber;
        $store_name = $request->store_name;

        $store = Store::where('store_name',$store_name)->first(); 
        
        $member = Member::where('serialnumber',$request->serialnumber)->first();

        $count_member = Member::where('serialnumber',$request->serialnumber)->count();

        $date = Carbon::now()->format('d/m/Y');
        
        $ids = Member::where('serialnumber',$request->serialnumber)->get();

        $id = Member::where('serialnumber',$request->serialnumber)->value('id');
        $status = Condition::where('member_id',$id)->value('status');

        $groupDates = array();

        foreach($ids as $id => $value) {
            $serviceDate = Service::where('member_id',$value->id)
                                  ->whereDate('created_at', '<', '2020-09-01 00:00:00')
                                  ->orderBy('id','desc')
                                  ->first();
            array_push($groupDates, $serviceDate);          
        }

        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','45')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','62')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','63')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','64')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','65')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','66')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }
        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','67')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);
        }

        foreach($ids as $id => $value) {
            $scanStatistic = Statistic::where('member_id',$value->id)
                                      ->where('store_id','61')
                                      ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                      ->orderBy('id','desc')
                                      ->first();
            array_push($groupDates, $scanStatistic);           
        }
       
        $groupDates = array_filter($groupDates);

        // $service_date = max($groupDates);

        if($groupDates == null) {
            $service_date = null;
        }
        else {
            foreach ($groupDates as $groupDate => $value) {
                $created_at = $value->created_at;
            }
            $service_date = date('d/m/Y',strtotime($created_at));
        }


            if($service_date == null) {
                $service_date = '';
                $expire = Member::where('serialnumber',$request->serialnumber)
                                ->value('expire');
            }

            else {
                // $service_date = strtr($service_date->date,'/','-');
                $service_date = strtr($service_date,'/','-');
                $expire = date('d/m/Y',strtotime($service_date . "+1 year"));
                
            }

            //ไม่มีบัตรสมาชิก
            if($request->serialnumber == NULL) {
                $obj = new \stdClass();
                $obj->status = "Null";
                return response()->json($obj);
            }
            
            if($count_member == 0) {
                $obj = new \stdClass();
                $obj->status = "Not Found";
                return response()->json($obj);
            }

            // หมดอายุของเอกการยาง
            if((date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) && $store_name == "MycareExpire") {        
                $code = str_random(8);

                $receive_privilege = new Statistic;
                $receive_privilege->member_id = $member->id;
                $receive_privilege->store_id = $store->id;
                $receive_privilege->date = $date;
                $receive_privilege->code = $code;
                $receive_privilege->save();

                $statisticCode = Statistic::where('member_id',$member->id)
                                          ->where('store_id',$store->id)->first();

                    $obj = new \stdClass();
                    $obj->store = $store;
                    $obj->member = $member;
                    $obj->store_name = $store_name;
                    $obj->statistic = $statisticCode;
                    $obj->status = "Pass";
                
                    return response()->json($obj);
            }

            if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) {        
                $obj = new \stdClass();
                $obj->status = "offline";
                return response()->json($obj);
            }
            //ตั้ง status
            if($status == "limit_1_perDay") {
            $dateST = Statistic::where('member_id',$member->id)->value('date');
            $dateST = strtr($date,'/','-');
            $date_d = date('d',strtotime($dateST));
            $date_m = date('m',strtotime($dateST));
            $date_y = date('Y',strtotime($dateST));
            $date_mY = $date_m.'/'.$date_y;
            $date_dmy = $date_d.'/'.$date_m.'/'.$date_y;
            $statisticx = Statistic::where('member_id',$member->id)
                                   ->where('date', 'like', '%'.$date_dmy)
                                   ->count();
                if($statisticx == 1) {
                    $statisticxx = Statistic::where('member_id',$member->id)
                                            ->where('store_id',$store->id)
                                            ->where('date',$date)->count();
                        if($statisticxx > 0) {
                            $obj = new \stdClass();
                            $obj->status = "Fail";
                            return response()->json($obj);
                        }
                }

                if($statisticx >= 1) {
                    $obj = new \stdClass();
                    $obj->status = "FULL";
                    return response()->json($obj);
                }
                // if($statisticx >= 2) {
                //     $obj = new \stdClass();
                //     $obj->status = "FULL";
                //     return response()->json($obj);
                // }
        }
        else {
            $statistic = Statistic::where('member_id',$member->id)
                                  ->where('store_id',$store->id)
                                  ->where('date',$date)->count();
                if($statistic > 0) {
                $obj = new \stdClass();
                $obj->status = "Fail";
                return response()->json($obj);
            }
        }//จบ

            $statistic = Statistic::where('member_id',$member->id)
                                  ->where('store_id',$store->id)
                                  ->where('date',$date)->count();

            if($statistic > 0) {
                $obj = new \stdClass();
                $obj->status = "Fail";
                return response()->json($obj);
            }
        
            else {
                $code = str_random(8);

                $receive_privilege = new Statistic;
                $receive_privilege->member_id = $member->id;
                $receive_privilege->store_id = $store->id;
                $receive_privilege->date = $date;
                $receive_privilege->code = $code;
                $receive_privilege->save();

                $statisticCode = Statistic::where('member_id',$member->id)
                                          ->where('store_id',$store->id)->first();

                // ตั้ง status
                if($status == "limit_1_perDay") {
                $dateST = Statistic::where('member_id',$member->id)->value('date');
                $dateST = strtr($date,'/','-');
                $date_d = date('d',strtotime($dateST));
                $date_m = date('m',strtotime($dateST));
                $date_y = date('Y',strtotime($dateST));
                $date_mY = $date_m.'/'.$date_y;
                $date_dmy = $date_d.'/'.$date_m.'/'.$date_y;
                $statisticFirst = Statistic::where('member_id',$member->id)
                                            ->where('date', 'like', '%'.$date_dmy)
                                            ->count();
                if($statisticFirst == 1) {
                    $objData = new \stdClass();
                    $objData->store = $store;
                    $objData->member = $member;
                    $objData->store_name = $store_name;
                    $objData->statistic = $statisticCode;
                    $objData->status = "PassFirst";
                    
                    return response()->json($objData);
                }
                // elseif($statisticFirst == 2) {
                //     $objData = new \stdClass();
                //     $objData->store = $store;
                //     $objData->member = $member;
                //     $objData->store_name = $store_name;
                //     $objData->statistic = $statisticCode;
                //     $objData->status = "PassSecond";
                    
                //     return response()->json($objData);
                // }
                else {
                    $objData = new \stdClass();
                    $objData->store = $store;
                    $objData->member = $member;
                    $objData->store_name = $store_name;
                    $objData->statistic = $statisticCode;
                    $objData->status = "Pass";
    	            return response()->json($objData);
                }
            }
            else {
                $objData = new \stdClass();
                $objData->store = $store;
                $objData->member = $member;
                $objData->store_name = $store_name;
                $objData->statistic = $statisticCode;
                $objData->status = "Pass";
            
                return response()->json($objData);
            }//จบ

                    // $obj = new \stdClass();
                    // $obj->store = $store;
                    // $obj->member = $member;
                    // $obj->store_name = $store_name;
                    // $obj->statistic = $statisticCode;
                    // $obj->status = "Pass";
                
                    // return response()->json($obj);
            }
    }
}
