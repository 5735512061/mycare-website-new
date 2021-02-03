<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;
use App\Reward;
use Carbon\Carbon;

class HomesController extends Controller
{
    public function index(Request $request) {
        $NUM_PAGE = 3;
        $stores = Store::where('type',"ร้านอาหาร")->paginate($NUM_PAGE);
        $lifestyles = Store::where('type',"ไลฟ์สไตล์")->paginate($NUM_PAGE);
        $rewards = Reward::paginate('4');
        $hour = Carbon::now()->format('H');
        if ($hour < 12) {
            $hour = 'ตอนเช้า';
        }
        elseif ($hour >= 12 && $hour < 13) {
            $hour = 'ตอนเที่ยง';
        }
        elseif ($hour >= 13 && $hour < 15) {
            $hour = 'ตอนบ่าย';
        }
        elseif ($hour >= 15 && $hour < 19) {
            $hour = 'ตอนเย็น';
        }
        else {
            $hour = 'ตอนดึก';
        }
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/frontend/index')->with('NUM_PAGE',$NUM_PAGE)
                                      ->with('page',$page)
                                      ->with('stores',$stores)
                                      ->with('lifestyles',$lifestyles)
                                      ->with('rewards',$rewards)
                                      ->with('hour',$hour);
    }
}
