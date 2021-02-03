<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Statistic;
use App\Store;

use Carbon\Carbon;
use Auth;

class AlliancesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:store');
    }

    public function alliance(Request $request) {
        $NUM_PAGE = 15;
        $statistics = Statistic::where('store_id',auth('store')->user()->id)
                               ->orderBy('created_at','desc')->paginate($NUM_PAGE);
                               
        $store = Store::where('id',auth('store')->user()->id)->first();
        $month_now = Carbon::now()->format('m');
        $year_now = Carbon::now()->format('Y'); 
        $now_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$month_now)
                                  ->whereYear('created_at',$year_now)->count();

        $previous_month = Carbon::now()->subMonth()->format('m');
        $previous_year = Carbon::now()->format('Y');
        
        $previousmonth_statistic = Statistic::where('store_id',$store->id)
                                  ->whereMonth('created_at',$previous_month)
                                  ->whereYear('created_at',$previous_year)->count();
        $total_statistic = Statistic::where('store_id',$store->id)->count();

        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/alliance/index')->with('NUM_PAGE',$NUM_PAGE)
                                             ->with('page',$page)
                                             ->with('statistics',$statistics)
                                             ->with('now_statistic',$now_statistic)
                                             ->with('previousmonth_statistic',$previousmonth_statistic)
                                             ->with('total_statistic',$total_statistic);
    }
}
