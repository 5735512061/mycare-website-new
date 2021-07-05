<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;
use App\Statistic;
use App\Member;
use App\Salesmember;
use App\Service;
use App\Condition;
use App\Salescondition;
use App\Salescar;
use App\Salesservice;

use Carbon\Carbon;
use Auth;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:memberandsale');
    }

    public function index(Request $request, $store_name){
        if(Auth::guard('member')->user() != NULL) {
            $serialnumber = Auth::guard('member')->user()->serialnumber;
        } else {
            $serialnumber = Auth::guard('sales_members')->user()->serialnumber;
        }

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
    
        if(Member::where('serialnumber',$serialnumber)->count() != 0) {
            $member = Member::where('serialnumber',$request->serialnumber)->first();
            $count_member = Member::where('serialnumber',$request->serialnumber)->count();
            $ids = Member::where('serialnumber',$request->serialnumber)->get();
            $id = Member::where('serialnumber',$request->serialnumber)->value('id');
    
            $date = Carbon::now()->format('d/m/Y'); //เหมือนกัน
            $groupDates = array(); //เหมือนกัน
    
            $status = Condition::where('member_id',$id)->value('status');
    
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
            
                $groupDates = array_filter($groupDates); //เหมือนกัน เก็บข้อมูลการใช้สิทธิ์ไว้ใน groupDates
    
                // ทำถึงตรงนี้แล้วนะ เริ่มมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมม 03/12/2020
                // $service_date = max($groupDates);
    
                // ใช้เหมือนกันได้ นำสิทธิ์ที่สแกนจากเอกการยางมาคิดต่อ เพื่อหาวันที่สแกน
                if($groupDates == null) {
                    $service_date = null;
                }
                else {
                    
                    foreach ($groupDates as $groupDate => $value) {
                        $created_at = $value->created_at;
                    }
                    $service_date = date('d/m/Y',strtotime($created_at));
                    
                }
                // จบ
    
                if($service_date == null) {
                    $service_date = '';
                    $expire = Member::where('serialnumber',$request->serialnumber)
                                    ->value('expire');
                }
    
                else {
                    // $service_date = strtr($service_date->date,'/','-');
                    $service_date = strtr($service_date,'/','-');
                    $expire = date('d/m/Y',strtotime($service_date . "+1 year"));
                    
                } //จบ สมาชิกทั่วไป
    
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
    
                // หมดอายุของเอกการยาง ต่ออายุบัตรโดยแอดมิน MycareExpire
                if((date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) && $store_name == "MycareExpire") {        
                    if(Member::where('serialnumber',$serialnumber)->count() != 0) { //ต่ออายุบัตรมายแคร์ สมาชิกทั่วไป
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
                            //จบ สมาชิกทั่วไป
                    }else { //ต่ออายุบัตรมายแคร์ สมาชิกเซลล์
                        $code = str_random(8);
                        $receive_privilege = new Statistic;
                        $receive_privilege->sales_id = $member->id;
                        $receive_privilege->store_id = $store->id;
                        $receive_privilege->date = $date;
                        $receive_privilege->code = $code;
                        $receive_privilege->save();
    
                        $statisticCode = Statistic::where('sales_id',$member->id)
                                                  ->where('store_id',$store->id)->first();
    
                            $obj = new \stdClass();
                            $obj->store = $store;
                            $obj->member = $member;
                            $obj->store_name = $store_name;
                            $obj->statistic = $statisticCode;
                            $obj->status = "Pass";
                        
                            return response()->json($obj);
                            //จบ สมาชิกทั่วไป
                    }
                }
                //จบ หมดอายุของเอกการยาง
    
                //บัตรหมดอายุ ไม่สามารถรับสิทธิ์ได้
                if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) {        
                    $obj = new \stdClass();
                    $obj->status = "offline";
                    return response()->json($obj);
                }
                //จบ
    
                if($status == "limit_1_perDay") {
                    if(Statistic::where('member_id',$member->id)->count() != 0) { //สมาชิกเคยรับสิทธิ์แล้ว
                            $dateST = Statistic::where('member_id',$member->id)->value('date');
                            $dateST = strtr($date,'/','-');
                            $date_d = date('d',strtotime($dateST));
                            $date_m = date('m',strtotime($dateST));
                            $date_y = date('Y',strtotime($dateST));
                            $date_mY = $date_m.'/'.$date_y;
                            $date_dmy = $date_d.'/'.$date_m.'/'.$date_y;
                            $statisticx = Statistic::where('member_id',$member->id)
                                                   ->where('date', 'like', '%'.$date_dmy)
                                                   ->where('store_id','!=','61')
                                                   ->count();
                                if($statisticx == 1) {
                                    $statisticxx = Statistic::where('member_id',$member->id)
                                                            ->where('store_id',$store->id)
                                                            ->where('store_id','!=','61')
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
                            //จบ สมาชิกทั่วไป
                    }
                } else {
                    if(Statistic::where('member_id',$member->id)->count() != 0 || Statistic::where('sales_id',$member->id)->count() != 0) { //สมาชิกเคยรับสิทธิ์แล้ว
                        if(Member::where('serialnumber',$serialnumber)->count() != 0) { //ไม่ได้จำกัดสิทธิ์ สมาชิกทั่วไป
                            $statistic = Statistic::where('member_id',$member->id)
                                                  ->where('store_id',$store->id)
                                                  ->where('date',$date)->count();
                                if($statistic > 0) {
                                $obj = new \stdClass();
                                $obj->status = "Fail";
                                return response()->json($obj);
                            }
                            //จบ สมาชิกทั่วไป
                        }
                    }
                }
    
                if(Member::where('serialnumber',$serialnumber)->count() != 0) { //สมาชิกทั่วไป
                    $statistic = Statistic::where('member_id',$member->id)
                                          ->where('store_id',$store->id)
                                          ->where('date',$date)->count();
                }
    
                if($statistic > 0) { //กรณีที่รับสิทธิ์แล้วในวันนั้น
                    $obj = new \stdClass();
                    $obj->status = "Fail";
                    return response()->json($obj);
                }
    
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
                        }//จบการตั้ง status
    
                            // $obj = new \stdClass();
                            // $obj->store = $store;
                            // $obj->member = $member;
                            // $obj->store_name = $store_name;
                            // $obj->statistic = $statisticCode;
                            // $obj->status = "Pass";
                        
                            // return response()->json($obj);
    
        } else {  
            $member = Salesmember::where('serialnumber',$request->serialnumber)->first();
            $count_member = Salesmember::where('serialnumber',$request->serialnumber)->count();
            $ids = Salesmember::where('serialnumber',$request->serialnumber)->get();
            $id = Salesmember::where('serialnumber',$request->serialnumber)->value('id');
    
            $date = Carbon::now()->format('d/m/Y'); //เหมือนกัน
            $groupDates = array(); //เหมือนกัน
    
            $status = Salescondition::where('member_id',$id)->value('status');
    
                foreach($ids as $id => $value) { 
                    $car_id = Salescar::where('member_id',$value->id)->value('id'); 
                    $serviceDate = Salesservice::where('car_id',$car_id)
                                               ->orderBy('id','desc')
                                               ->first();
                    array_push($groupDates, $serviceDate);          
                }
    
                foreach($ids as $id => $value) {
                    
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                              ->where('store_id','45')
                                              ->orderBy('id','desc')
                                              ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                              ->where('store_id','62')
                                              ->orderBy('id','desc')
                                              ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','63')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','64')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','65')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','66')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);
                }
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','67')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);
                }
    
                foreach($ids as $id => $value) {
                    $scanStatistic = Statistic::where('sales_id',$value->id)
                                            ->where('store_id','61')
                                            ->orderBy('id','desc')
                                            ->first();
                    array_push($groupDates, $scanStatistic);           
                }
            
                $groupDates = array_filter($groupDates); //เหมือนกัน เก็บข้อมูลการใช้สิทธิ์ไว้ใน groupDates
    
                // ทำถึงตรงนี้แล้วนะ เริ่มมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมมม 03/12/2020
                // $service_date = max($groupDates);
    
                // ใช้เหมือนกันได้ นำสิทธิ์ที่สแกนจากเอกการยางมาคิดต่อ เพื่อหาวันที่สแกน
                if($groupDates == null) {
                    $service_date = null;
                }
                else {
                    
                    foreach ($groupDates as $groupDate => $value) {
                        $created_at = $value->created_at;
                    }
                    $service_date = date('d/m/Y',strtotime($created_at));
                    
                }
                // จบ
    
                if($service_date == null) {
                    $service_date = '';
                    $expire = Salesmember::where('serialnumber',$request->serialnumber)
                                    ->value('expire');
                }
    
                else {
                    // $service_date = strtr($service_date->date,'/','-');
                    $service_date = strtr($service_date,'/','-');
                    $expire = date('d/m/Y',strtotime($service_date . "+1 year"));
                    
                } //จบ สมาชิกทั่วไป
    
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
    
                // หมดอายุของเอกการยาง ต่ออายุบัตรโดยแอดมิน MycareExpire
                if((date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) && $store_name == "MycareExpire") {        
                    //ต่ออายุบัตรมายแคร์ สมาชิกเซลล์
                        $code = str_random(8);
                        $receive_privilege = new Statistic;
                        $receive_privilege->sales_id = $member->id;
                        $receive_privilege->store_id = $store->id;
                        $receive_privilege->date = $date;
                        $receive_privilege->code = $code;
                        $receive_privilege->save();
    
                        $statisticCode = Statistic::where('sales_id',$member->id)
                                                  ->where('store_id',$store->id)->first();
    
                            $obj = new \stdClass();
                            $obj->store = $store;
                            $obj->member = $member;
                            $obj->store_name = $store_name;
                            $obj->statistic = $statisticCode;
                            $obj->status = "Pass";
                        
                            return response()->json($obj);
                            //จบ สมาชิกทั่วไป
                }
                //จบ หมดอายุของเอกการยาง
    
                //บัตรหมดอายุ ไม่สามารถรับสิทธิ์ได้
                if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) {        
                    $obj = new \stdClass();
                    $obj->status = "offline";
                    return response()->json($obj);
                }
                //จบ
    
                if($status == "limit_1_perDay") {
                    if(Statistic::where('sales_id',$member->id)->count() != 0) { //สมาชิกเคยรับสิทธิ์แล้ว
                            $dateST = Statistic::where('sales_id',$member->id)->value('date');
                            $dateST = strtr($date,'/','-');
                            $date_d = date('d',strtotime($dateST));
                            $date_m = date('m',strtotime($dateST));
                            $date_y = date('Y',strtotime($dateST));
                            $date_mY = $date_m.'/'.$date_y;
                            $date_dmy = $date_d.'/'.$date_m.'/'.$date_y;
                            $statisticx = Statistic::where('sales_id',$member->id)
                                                ->where('date', 'like', '%'.$date_dmy)
                                                ->where('store_id','!=','61')
                                                ->count();
                                if($statisticx == 1) {
                                    $statisticxx = Statistic::where('sales_id',$member->id)
                                                            ->where('store_id',$store->id)
                                                            ->where('store_id','!=','61')
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
                            //จบ สมาชิกทั่วไป
                    }
                } else {
                    if(Statistic::where('member_id',$member->id)->count() != 0 || Statistic::where('sales_id',$member->id)->count() != 0) { //สมาชิกเคยรับสิทธิ์แล้ว
                        if(Member::where('serialnumber',$serialnumber)->count() == 0) { //ไม่ได้จำกัดสิทธิ์ สมาชิกทั่วไป
                            $statistic = Statistic::where('sales_id',$member->id)
                                                  ->where('store_id',$store->id)
                                                  ->where('date',$date)->count();
                                if($statistic > 0) {
                                $obj = new \stdClass();
                                $obj->status = "Fail";
                                return response()->json($obj);
                            }
                            //จบ สมาชิกทั่วไป
                        }
                    }
                }
    
                if(Member::where('serialnumber',$serialnumber)->count() == 0) { //สมาชิกทั่วไป
                    $statistic = Statistic::where('sales_id',$member->id)
                                          ->where('store_id',$store->id)
                                          ->where('date',$date)->count();
                }
    
                if($statistic > 0) { //กรณีที่รับสิทธิ์แล้วในวันนั้น
                    $obj = new \stdClass();
                    $obj->status = "Fail";
                    return response()->json($obj);
                }
    
                $code = str_random(8);
    
                        $receive_privilege = new Statistic;
                        $receive_privilege->sales_id = $member->id;
                        $receive_privilege->store_id = $store->id;
                        $receive_privilege->date = $date;
                        $receive_privilege->code = $code;
                        $receive_privilege->save();
    
                        $statisticCode = Statistic::where('sales_id',$member->id)
                                                ->where('store_id',$store->id)->first();
                                                // ตั้ง status
                        if($status == "limit_1_perDay") {
                            $dateST = Statistic::where('sales_id',$member->id)->value('date');
                            $dateST = strtr($date,'/','-');
                            $date_d = date('d',strtotime($dateST));
                            $date_m = date('m',strtotime($dateST));
                            $date_y = date('Y',strtotime($dateST));
                            $date_mY = $date_m.'/'.$date_y;
                            $date_dmy = $date_d.'/'.$date_m.'/'.$date_y;
                            $statisticFirst = Statistic::where('sales_id',$member->id)
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
                        }//จบการตั้ง status
    
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
