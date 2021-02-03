<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Reward;
use App\Service;
use App\Member;
use App\Salesmember;
use App\Salescar;
use App\Salesservice;
use App\Statistic;
use App\Historyreward;
use Auth;
use Carbon\Carbon;

class RewardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:memberandsale');
    }

    public function reward_redem($id) {
        $reward = Reward::findOrFail($id);
        
        if(Auth::guard('member')->user() != NULL) {
            $member = Auth::guard('member')->user();
            $member_id = Member::where('serialnumber',$member->serialnumber)->get();
            $member_onlyID= $member_id->map(function($xx) {return $xx->id;});
            $membersames = Service::whereIn('member_id',$member_onlyID)->get();
            $points = Statistic::whereIn('member_id',$member_onlyID)->get();
            $scores = Historyreward::whereIn('member_id',$member_onlyID)->get();
        } else {
            $member = Auth::guard('sales_members')->user();
            $member_id = Salesmember::where('id',$member->id)->get();
            $member_onlyID= $member_id->map(function($xx) {return $xx->id;});

            $car_id = Salescar::where('member_id',$member->id)->get();
            $car_onlyID = $car_id->map(function($xx) {return $xx->id;});

            $membersames = Salesservice::whereIn('car_id',$car_onlyID)->get();
            $points = Statistic::whereIn('sales_id',$member_onlyID)->get();
            $scores = Historyreward::whereIn('sales_id',$member_onlyID)->get();
        }

        return view('frontend/member/reward/redem')->with('reward',$reward)
                                                   ->with('membersames',$membersames)
                                                   ->with('points',$points)
                                                   ->with('scores',$scores);
    }

    public function reward_success(Request $request) {
        if(Auth::guard('member')->user() != NULL) {
            $member = Auth::guard('member')->user()->serialnumber;
            $member_id = Member::where('id',auth('member')->user()->id)->value('id');
            $membersames = Service::where('member_id',$member_id)->get();
            $reward = Reward::where('id',$request->get('id'))->get();
            $reward_id = Reward::where('id',$request->get('id'))->value('id');
            $date = Carbon::now()->format('d/m/Y');
                $history = new Historyreward;
                $history->member_id = $member_id;
                $history->reward_id = $reward_id;
                $history->date = $date;
                $history->save();
            $scores = Historyreward::where('member_id',auth('member')->user()->id)->get();
            $points = Statistic::where('member_id',auth('member')->user()->id)->get();
        } else { 
            $member = Auth::guard('sales_members')->user()->serialnumber;
            $member_id = Salesmember::where('id',auth('sales_members')->user()->id)->value('id'); 
            $car_id = Salescar::where('member_id',auth('sales_members')->user()->id)->value('id');
            $membersames = Salesservice::where('car_id',$car_id)->get();
            $reward = Reward::where('id',$request->get('id'))->get();
            $reward_id = Reward::where('id',$request->get('id'))->value('id');
            $date = Carbon::now()->format('d/m/Y');
                $history = new Historyreward;
                $history->sales_id = $member_id;
                $history->reward_id = $reward_id;
                $history->date = $date;
                $history->save();
            $scores = Historyreward::where('sales_id',auth('sales_members')->user()->id)->get();
            $points = Statistic::where('sales_id',auth('sales_members')->user()->id)->get();
        }
        
        return view('frontend/member/reward/success')->with('membersames',$membersames)
                                                     ->with('reward',$reward)
                                                     ->with('scores',$scores)
                                                     ->with('points',$points);
      }
}
