<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Reward;
use Auth;

class PrivilegesController extends Controller
{
    public function point() {
        return view('/frontend/privilege/point');
    }

    public function reward_points() {
        if(Auth::guard('member')->user() != NULL) {
            $rewards = Reward::where('reward_type',"!=",NULL)->where('user_type','สมาชิกทั่วไป')->get();
            return view('/frontend/privilege/reward-points')->with('rewards',$rewards);
            
        }
        elseif(Auth::guard('sales_members')->user() != NULL) {
            $rewards = Reward::where('reward_type',"!=",NULL)->where('user_type','เซลล์')->get();
            return view('/frontend/privilege/reward-points-sale')->with('rewards',$rewards);
        }
    }

    public function reward_detail($id) {
        $reward = Reward::findOrFail($id);
        return view('/frontend/privilege/reward-detail')->with('reward',$reward);
    }

    public function rewardFood() {
        $rewards = Reward::where('reward_type',"food")->get();
        return view('/frontend/reward/food')->with('rewards',$rewards);
    }

    public function rewardGadget() {
        $rewards = Reward::where('reward_type',"gadget")->get();
        return view('/frontend/reward/gadget')->with('rewards',$rewards);
    }

    public function rewardOther() {
        $rewards = Reward::where('reward_type',"other")->get();
        return view('/frontend/reward/other')->with('rewards',$rewards);
    }
}
