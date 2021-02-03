<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;
use App\Statistic;
use App\Member;
use App\Service;

use Carbon\Carbon;

class ExpireStoresController extends Controller
{
    public function expire(Request $request, $store_name){
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
    	return view('/frontend/member/privilege/store_expire')->with('store',$store)
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

                    $obj = new \stdClass();
                    $obj->store = $store;
                    $obj->member = $member;
                    $obj->store_name = $store_name;
                    $obj->statistic = $statisticCode;
                    $obj->status = "Pass";
                
                    return response()->json($obj);
            }
    }
}
