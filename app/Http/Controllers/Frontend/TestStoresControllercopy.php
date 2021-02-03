<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;
use App\Statistic;
use App\Member;

use Carbon\Carbon;

class StoresController extends Controller
{
    public function index(Request $request, $store_name){
        $store = Store::where('store_name',$store_name)->first();
    	$store_name = $store_name;
        $month_now = Carbon::now()->format('m');
        $now_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$month_now)->count();
        $previous_month = Carbon::now()->subMonth()->format('m');
        $previousmonth_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$previous_month)->count();
        $total_statistic = Statistic::where('store_id',$store->id)->count();
    	return view('/frontend/member/privilege/store')->with('store',$store)
    										           ->with('store_name',$store_name)
                                                       ->with('total_statistic',$total_statistic)
                                                       ->with('now_statistic',$now_statistic)
                                                       ->with('previousmonth_statistic',$previousmonth_statistic);
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

        return response()->json($request->all());

    	$store = Store::where('store_name',$store_name)->first();
		$member = Member::where('serialnumber','like','%'.$serialnumber.'%')->first();
        $count_member = count($member);
        
    	$date = Carbon::now()->format('d/m/Y');

        $expire = Member::where('serialnumber',$request->serialnumber)
                        ->value('expire');

            if($serialnumber == null) {
                $obj = new \stdClass();
                $obj->status = "Null";
                return response()->json($obj);
            }

            if($count_member == 0) {
                $obj = new \stdClass();
                $obj->status = "Not Found";
                return response()->json($obj);
            }

            if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') >= date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d')) {        
                $obj = new \stdClass();
                $obj->status = "offline";
                return response()->json($obj);
            }
        
        // if($store_name == "ProClean") {
        //     $dateST = Statistic::where('member_id',$member->id)->value('date');
        //     $dateST = strtr($date,'/','-');
        //     $date_d = date('d',strtotime($dateST));
        //     $date_m = date('m',strtotime($dateST));
        //     $date_y = date('Y',strtotime($dateST));
        //     $date_mY = $date_m.'/'.$date_y;
        //     $statisticx = Statistic::where('member_id',$member->id)
        //                            ->where('store_id',$store->id)
        //                            ->where('date', 'like', '%'.$date_mY)
        //                            ->count();
        //         if($statisticx == 1) {
        //             $statisticxx = Statistic::where('member_id',$member->id)
        //                                    ->where('store_id',$store->id)
        //                                    ->where('date',$date)->count();
        //                 if($statisticxx > 0) {
        //                     $obj = new \stdClass();
        //                     $obj->status = "Fail";
        //                     return response()->json($obj);
        //                 }
        //         }

        //         if($statisticx >= 2) {
        //         $obj = new \stdClass();
        //         $obj->status = "FULL";
        //         return response()->json($obj);
        //     }
        // }
        // else {
        //     $statistic = Statistic::where('member_id',$member->id)
        //                           ->where('store_id',$store->id)
        //                           ->where('date',$date)->count();
        //         if($statistic > 0) {
        //         $obj = new \stdClass();
        //         $obj->status = "Fail";
        //         return response()->json($obj);
        //     }
        // }
        
        $statistic = Statistic::where('member_id',$member->id)
                              ->where('store_id',$store->id)
                              ->where('date',$date)->count();
            if($statistic > 0) {
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

        // if($store_name == "ProClean") {
        //     $dateST = Statistic::where('member_id',$member->id)->value('date');
        //     $dateST = strtr($date,'/','-');
        //     $date_d = date('d',strtotime($dateST));
        //     $date_m = date('m',strtotime($dateST));
        //     $date_y = date('Y',strtotime($dateST));
        //     $date_mY = $date_m.'/'.$date_y;
        //     $statisticFirst = Statistic::where('member_id',$member->id)
        //                                 ->where('store_id',$store->id)
        //                                 ->where('date', 'like', '%'.$date_mY)
        //                                 ->count();
        //         if($statisticFirst == 1) {
        //             $objData = new \stdClass();
        //             $objData->store = $store;
        //             $objData->member = $member;
        //             $objData->store_name = $store_name;
        //             $objData->statistic = $statisticCode;
        //             $objData->status = "PassFirst";
                    
        //             return response()->json($objData);
        //         }
        //         elseif($statisticFirst == 2) {
        //             $objData = new \stdClass();
        //             $objData->store = $store;
        //             $objData->member = $member;
        //             $objData->store_name = $store_name;
        //             $objData->statistic = $statisticCode;
        //             $objData->status = "PassSecond";
                    
        //             return response()->json($objData);
        //         }
        //         else {
        //             $objData = new \stdClass();
        //             $objData->store = $store;
        //             $objData->member = $member;
        //             $objData->store_name = $store_name;
        //             $objData->statistic = $statisticCode;
        //             $objData->status = "Pass";
    	//             return response()->json($objData);
        //         }
        // }
        // else {
        //     $objData = new \stdClass();
        //     $objData->store = $store;
        //     $objData->member = $member;
        //     $objData->store_name = $store_name;
        //     $objData->statistic = $statisticCode;
        //     $objData->status = "Pass";
        
    	//     return response()->json($objData);
        // }

        $objData = new \stdClass();
            $objData->store = $store;
            $objData->member = $member;
            $objData->store_name = $store_name;
            $objData->statistic = $statisticCode;
            $objData->status = "Pass";
        
    	    return response()->json($objData);
            
    }
}
