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
    
        if(Member::where('serialnumber',$serialnumber)->count() != 0) {
            $member = Member::where('serialnumber',$request->serialnumber)->first();
            $count_member = Member::where('serialnumber',$request->serialnumber)->count();
            $ids = Member::where('serialnumber',$request->serialnumber)->get();
            $id = Member::where('serialnumber',$request->serialnumber)->value('id');
    
            $date = Carbon::now()->format('d/m/Y'); //เหมือนกัน
            $groupDates = array(); //เหมือนกัน
    
            $status = Condition::where('member_id',$id)->value('status');
    
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
    
                $code = str_random(8);
    
                        $receive_privilege = new Statistic;
                        $receive_privilege->member_id = $member->id;
                        $receive_privilege->store_id = $store->id;
                        $receive_privilege->date = $date;
                        $receive_privilege->code = $code;
                        $receive_privilege->save();
    
                        $statisticCode = Statistic::where('member_id',$member->id)
                                                ->where('store_id',$store->id)->first();

                            $objData = new \stdClass();
                            $objData->store = $store;
                            $objData->member = $member;
                            $objData->store_name = $store_name;
                            $objData->statistic = $statisticCode;
                            $objData->status = "Pass";
                        
                            return response()->json($objData);
    
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
    
                if(Member::where('serialnumber',$serialnumber)->count() == 0) { //สมาชิกทั่วไป
                    $statistic = Statistic::where('sales_id',$member->id)
                                          ->where('store_id',$store->id)
                                          ->where('date',$date)->count();
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
                                                
                            $objData = new \stdClass();
                            $objData->store = $store;
                            $objData->member = $member;
                            $objData->store_name = $store_name;
                            $objData->statistic = $statisticCode;
                            $objData->status = "Pass";
                        
                            return response()->json($objData);
    
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
