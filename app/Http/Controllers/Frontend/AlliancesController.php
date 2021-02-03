<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Store;

class AlliancesController extends Controller
{
    public function index() {
        $stores = Store::get();
        return view('frontend/alliance/index')->with('stores',$stores);
    }

    public function store() {
        $stores = Store::where('type',"ร้านอาหาร")->get();
        return view('frontend/alliance/store')->with('stores',$stores);
    }

    public function lifestyle() {
        $lifestyles = Store::where('type',"ไลฟ์สไตล์")->get();
        return view('frontend/alliance/lifestyle')->with('lifestyles',$lifestyles);
    }

    public function carservice() {
        $carservices = Store::where('type',"บริการด้านรถยนต์")->get();
        return view('frontend/alliance/car-service')->with('carservices',$carservices);
    }

    public function hotel() {
        $hotels = Store::where('type',"โรงแรม")->get();
        return view('frontend/alliance/hotel')->with('hotels',$hotels);
    }

    public function detail($id) {
        $alliance = Store::findOrFail($id);
        return view('frontend/alliance/detail')->with('alliance',$alliance);
    }
}
