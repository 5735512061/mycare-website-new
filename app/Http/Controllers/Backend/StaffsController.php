<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Member;
use App\Historyreward;
use App\Statistic;
use App\Service;
use App\Salesmember;
use App\Salescar;
use App\Salesservice;
use App\Store;


use Validator;

class StaffsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    
    public function member(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::whereIn('membertype',["ลูกค้าทั่วไป","ป้ายเขียว-เหลือง","สมัครผ่านเว็บไซต์"])
                         ->where('serialnumber','!=',NULL)
                         ->groupBy('serialnumber')->orderBy('id','asc')
                         ->paginate($NUM_PAGE);
        $date = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/member/member')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('members',$members)
                                                  ->with('date',$date);
    }

    public function information_member(Request $request, $id) {
        $NUM_PAGE = 15;
    	$member = Member::findOrFail($id);
        $countmembers = Member::where('serialnumber',$member->serialnumber)
                              ->where('carnumber', '!=', NULL)
                              ->orderBy('id','asc')->count();
        $countcarnull = Member::where('serialnumber',$member->serialnumber)
                              ->where('carnumber', '==', NULL)
                              ->orderBy('id','asc')->count();
        $members = Member::where('serialnumber',$member->serialnumber)
                         ->where('carnumber', '!=', NULL)
                         ->orderBy('id','asc')->get();
        $member_id = Member::where('serialnumber',$member->serialnumber)->value('id');
        $membersames = Member::where('serialnumber',$member->serialnumber)->get();
        $membertype = Member::where('serialnumber',$member->serialnumber)->value('membertype');
        $cntmember = Member::where('serialnumber',$member->serialnumber)->get();
        $scores = Historyreward::where('member_id',$member_id)->get();
        $points = Statistic::where('member_id',$member_id)->get();
        $dateNow = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/member/information-member')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('member',$member)
                                                               ->with('members',$members)
                                                               ->with('countmembers',$countmembers)
                                                               ->with('countcarnull',$countcarnull)
                                                               ->with('membertype',$membertype)
                                                               ->with('cntmember',$cntmember)
                                                               ->with('member_id',$member_id)
                                                               ->with('membersames',$membersames)
                                                               ->with('scores',$scores)
                                                               ->with('points',$points)
                                                               ->with('dateNow',$dateNow);
    }
    
    public function create_member(Request $request, $id) {
        $member = Member::findOrFail($id);
        return view('/backend/staff/member/create-member')->with('member',$member);
    }

    public function create_memberPost(Request $request) {
        // $validator = Validator::make($request->all(), $this->Createrules(), $this->Createmessages());
            // if($validator->passes()) {
                $member = $request->all();
                $serialnumber = $request->get('serialnumber');
                // $member['password'] = bcrypt($member['serialnumber']);
                $member = Member::create($member);
                $member->serialnumber = $serialnumber;
                $member->save();
                return redirect()->action('Backend\StaffsController@member');
            // }
            // else {
                // return back()->withErrors($validator)->withInput();
            // } 
    }

    public function service(Request $request, $id) {
        $NUM_PAGE = 10;
        $member_id = Member::findOrFail($id);
        $services = Service::where('member_id',$member_id->id)
                           ->groupBy('date')->orderBy('id','asc')->get();
        $miles = Service::where('member_id',$member_id->id)->groupBy('date')->orderBy('id','desc')->value('miles');
        $members = Member::where('id',$member_id->id)->get();
        $dateNow = Carbon::now()->format('d/m/Y');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/service/index')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('services',$services)
                                                   ->with('member_id',$member_id->id)
                                                   ->with('members',$members)
                                                   ->with('miles',$miles)
                                                   ->with('dateNow',$dateNow);
    }

    public function create_service($id) {
        $member = Member::findOrFail($id);
        return view('/backend/staff/service/create-service')->with('member',$member);
    }

    public function create_servicePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_service(), $this->messages_service());
        if($validator->passes()) {
            $branch = $request->get('branch');
            $date = $request->get('date');
            $miles = $request->get('miles');
            $service = $request->get('service');
            $amount = $request->get('amount');
            $unit = $request->get('unit');
            $price = $request->get('price');
            $discount = $request->get('discount');
            $discountturn = $request->get('discountturn');
            $comment = $request->get('comment');
            $member_id = $request->get('member_id');
            
                for ($i=0; $i < count($service) ; $i++) { 
                    $dataservice = new Service;
                    $dataservice->branch = $branch;
                    $dataservice->date = $date;
                    $dataservice->miles = $miles;
                    $dataservice->discount = $discount;
                    $dataservice->discountturn = $discountturn;
                    $dataservice->comment = $comment;
                    $dataservice->service = $service[$i];
                    $dataservice->amount = $amount[$i];
                    $dataservice->unit = $unit[$i];
                    $dataservice->price = $price[$i];
                    $dataservice->member_id = $member_id;
                    $dataservice->save();
                }
            $request->session()->flash('alert-success', 'บันทึกข้อมูลสำเร็จ');
            return back();
        }
        else {
            $member_id = $request->get('member_id');
            return redirect('/staff/create-service/'.$member_id)->withErrors($validator)->withInput();
        }
    }

    public function service_information(Request $request, $id) {
        $NUM_PAGE = 10;
        $service = Service::findOrFail($id);
        $services = Service::where('member_id',$service->member_id)
                           ->where('date',$service->date)
                           ->orderBy('id','asc')->get();
        $service_date = Service::where('member_id',$service->member_id)
                               ->where('date',$service->date)
                               ->orderBy('id','asc')->value('date');
        $service_mile = Service::where('member_id',$service->member_id)
                               ->where('date',$service->date)
                               ->orderBy('id','asc')->value('miles');
        $service_branch = Service::where('member_id',$service->member_id)
                                 ->where('date',$service->date)
                                 ->orderBy('id','asc')->value('branch');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/service/service-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('services',$services)
                                                                 ->with('service_date',$service_date)
                                                                 ->with('service_mile',$service_mile)
                                                                 ->with('service_branch',$service_branch);
    }

    public function search_member(Request $request) {
        $NUM_PAGE = 50;

        if($request->get('serialnumber')) {
            $serialnumber = $request->get('serialnumber');
            $id = Member::where('serialnumber',$serialnumber)->value('id');
            $members = Member::where('id',$id)
                            ->whereIn('membertype',["ลูกค้าทั่วไป","ป้ายเขียว-เหลือง","สมัครผ่านเว็บไซต์"])->paginate($NUM_PAGE);
        }
        else {
            $members = '0';
        }

        $date = Carbon::now()->format('d/m/Y');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/member/member')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('members',$members)
                                                  ->with('date',$date);
    }

    public function sales(Request $request) {
        $NUM_PAGE = 50;
        $members = Salesmember::where('serialnumber','!=',NULL)
                              ->groupBy('serialnumber')->orderBy('id','asc')
                              ->paginate($NUM_PAGE);
        $date = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/sales/member')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('members',$members)
                                                  ->with('date',$date);
    }

    public function salesRegister() {
        return view('/backend/staff/sales/register');
    }

    public function salesRegisterPost(Request $request) {
        // $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        // if($validator->passes()) {
            $card_id = $request->get('card_id');
            $title = $request->get('title');
            $name = $request->get('name');
            $surname = $request->get('surname');
            $bday = $request->get('bday');
            $tel = $request->get('tel');
            $date = $request->get('date');
            $expire = $request->get('expire');
            $address = $request->get('address');    
            $moo = $request->get('moo');
            $village = $request->get('village');
            $road = $request->get('road');
            $district = $request->get('district');
            $amphoe = $request->get('amphoe');
            $province = $request->get('province');
            $zipcode = $request->get('zipcode');
            $password = null;
            $file = $request->get('file');

            $member = new Salesmember;
            $member->card_id = $card_id;
            $member->title = $title;
            $member->name = $name;
            $member->surname = $surname;
            $member->bday = $bday;
            $member->tel = $tel;
            $member->date = $date;
            $member->expire = $expire;
            $member->address = $address;
            $member->moo = $moo;
            $member->village = $village;
            $member->road = $road;
            $member->district = $district;
            $member->amphoe = $amphoe;
            $member->province = $province;
            $member->zipcode = $zipcode;
            $member->password = $password;

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                $file->move('images/file/', $filename);
                $path = 'images/'.$filename;
                $member->file = $filename;
                $member->save();
            }
            $member->save();

            $request->session()->flash('alert-success', 'สมัครสมาชิกเรียบร้อยแล้วค่ะ กรุณารอการติดต่อกลับ');
            return back();
        }
        // else{
        //         $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
        //         return redirect('/staff/sales-register')->withErrors($validator)->withInput();   
        //     }
    // }

    public function informationSales(Request $request, $id) {
        $NUM_PAGE = 15;
        $member = Salesmember::findOrFail($id);
        
        $countmembers = Salescar::where('member_id',$member->id)     
                                ->orderBy('id','asc')->count();
        $members = Salesmember::where('serialnumber',$member->serialnumber)
                              ->orderBy('id','asc')->get();

        // คิดจากตารางสมาชิกเซลล์
        $member_id = Salesmember::where('id',$member->id)->get();
        $member_onlyID= $member_id->map(function($xx) {return $xx->id;});

        // คิดจากตารางรถ
        $car_id = Salescar::where('member_id',$member->id)->get();
        $car_onlyID= $car_id->map(function($xx) {return $xx->id;});

        $membersames = Salesservice::whereIn('car_id',$car_onlyID)->get();
        $cntmember = Salescar::where('member_id',$member->id)->get();

        $scores = Historyreward::whereIn('sales_id',$member_onlyID)->get();
        $points = Statistic::whereIn('sales_id',$member_onlyID)->get();

        $dateNow = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;

        return view('/backend/staff/sales/information-member')->with('NUM_PAGE',$NUM_PAGE)
                                                              ->with('page',$page)
                                                              ->with('member',$member)
                                                              ->with('members',$members)
                                                              ->with('countmembers',$countmembers)
                                                              ->with('cntmember',$cntmember)
                                                              ->with('member_id',$member_id)
                                                              ->with('membersames',$membersames)
                                                              ->with('scores',$scores)
                                                              ->with('points',$points)
                                                              ->with('dateNow',$dateNow);
    }

    public function createSales(Request $request, $id) {
        $member = Salesmember::findOrFail($id);
        $date = Carbon::now()->format('dmY');
        return view('/backend/staff/sales/create-sales')->with('member',$member)
                                                        ->with('date',$date);
    }

    public function createSalesPost(Request $request) {
        $member = $request->all();
        $member = Salescar::create($member);
        return redirect()->action('Backend\StaffsController@sales');
    }

    public function serviceSales(Request $request, $id) {
        $NUM_PAGE = 10;
        $member_id = Salescar::findOrFail($id);
        $services = Salesservice::where('car_id',$member_id->id)
                                ->groupBy('date')->orderBy('id','asc')->get();
        $members = Salescar::where('id',$member_id->id)->get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/sales/service/index')->with('NUM_PAGE',$NUM_PAGE)
                                                         ->with('page',$page)
                                                         ->with('services',$services)
                                                         ->with('member_id',$member_id->id)
                                                         ->with('members',$members);
    }

    public function createServiceSales($id) {
        $member = Salescar::findOrFail($id);
        return view('/backend/staff/sales/service/create-service')->with('member',$member);
    }

    public function createServiceSalesPost(Request $request) {
        // $validator = Validator::make($request->all(), $this->rules_service(), $this->messages_service());
        // if($validator->passes()) {
            $branch = $request->get('branch');
            $date = $request->get('date');
            $bill_number = $request->get('bill_number');
            $service = $request->get('service');
            $amount = $request->get('amount');
            $unit = $request->get('unit');
            $price = $request->get('price');
            $discount = $request->get('discount');
            $discountturn = $request->get('discountturn');
            $comment = $request->get('comment');
            $car_id = $request->get('car_id');
            
                for ($i=0; $i < count($service) ; $i++) { 
                    $dataservice = new Salesservice;
                    $dataservice->branch = $branch;
                    $dataservice->date = $date;
                    $dataservice->bill_number = $bill_number;
                    $dataservice->discount = $discount;
                    $dataservice->discountturn = $discountturn;
                    $dataservice->comment = $comment;
                    $dataservice->service = $service[$i];
                    $dataservice->amount = $amount[$i];
                    $dataservice->unit = $unit[$i];
                    $dataservice->price = $price[$i];
                    $dataservice->car_id = $car_id;
                    $dataservice->save();
                }
            $request->session()->flash('alert-success', 'สมัครสมาชิกเรียบร้อยแล้วค่ะ กรุณารอการติดต่อกลับ');
            return back();
        }
        // else {
            // $car_id = $request->get('car_id');
            // return redirect('/staff/createService-sales/'.$car_id)->withErrors($validator)->withInput();
        // }
    // }

    public function serviceInformationSales(Request $request, $id) {
        $NUM_PAGE = 10;
        $service = Salesservice::findOrFail($id);
        $services = Salesservice::where('car_id',$service->car_id)
                                ->where('date',$service->date)
                                ->orderBy('id','asc')->get();
        $service_date = Salesservice::where('car_id',$service->car_id)
                                    ->where('date',$service->date)
                                    ->orderBy('id','asc')->value('date');
        $bill_number = Salesservice::where('car_id',$service->car_id)
                                    ->where('date',$service->date)
                                    ->orderBy('id','asc')->value('bill_number');
        $service_branch = Salesservice::where('car_id',$service->car_id)
                                      ->where('date',$service->date)
                                      ->orderBy('id','asc')->value('branch');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/sales/service/service-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('services',$services)
                                                                       ->with('service_date',$service_date)
                                                                       ->with('bill_number',$bill_number)
                                                                       ->with('service_branch',$service_branch);
    }

    public function salesSearch(Request $request) {
        $NUM_PAGE = 50;
        if($request->get('serialnumber')) {
            $serialnumber = $request->get('serialnumber');
            $id = Salesmember::where('serialnumber',$serialnumber)->value('id');
            $members = Salesmember::where('id',$id)->paginate($NUM_PAGE);
            $count = count($members);
                if($count == 0) {
                    $members = '0';
                }
        }

        if($request->get('tel')) {
            $tel = $request->get('tel');
            $id = Salesmember::where('tel',$tel)->value('id');
            $members = Salesmember::where('id',$id)->paginate($NUM_PAGE);
            $count = count($members);
                if($count == 0) {
                    $members = '0';
                }
        }

        $date = Carbon::now()->format('d/m/Y');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/staff/sales/member')->with('NUM_PAGE',$NUM_PAGE)
                                                 ->with('page',$page)
                                                 ->with('members',$members)
                                                 ->with('date',$date);
    }

    public function summary_statistic(Request $request) {
        $NUM_PAGE = 50;
        $stores = Store::paginate($NUM_PAGE);
        $dateNow = Carbon::now()->format('m');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/alliance/summary-statistic')->with('NUM_PAGE',$NUM_PAGE)
                                                                ->with('page',$page)
                                                                ->with('stores',$stores)
                                                                ->with('dateNow',$dateNow);
    }

    public function summary_statisticID(Request $request,$id) {
        $NUM_PAGE = 50; 
        $stores = Store::where('id',$id)->get();
        $store_name = Store::where('id',$id)->value('name');
        $statistic = Statistic::where('store_id',$id)->value('store_id');
        $dateNow = Carbon::now()->format('m');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/alliance/summary-statisticID')->with('NUM_PAGE',$NUM_PAGE)
                                                                  ->with('page',$page)
                                                                  ->with('stores',$stores)
                                                                  ->with('store_name',$store_name)
                                                                  ->with('dateNow',$dateNow)
                                                                  ->with('statistic',$statistic);
    }

    public function SummarystatisticMonth(Request $request, $store_name, $year , $month) {
        $NUM_PAGE = 50; 
        $store_id = Store::where('name',$store_name)->value('id');
        $monthN = date('m', strtotime($month));
        $statistics = Statistic::where('store_id',$store_id)
                               ->whereYear('created_at',$year)
                               ->whereMonth('created_at',$monthN)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/staff/alliance/summary-statisticMonth')->with('NUM_PAGE',$NUM_PAGE)
                                                                     ->with('page',$page)
                                                                     ->with('statistics',$statistics)
                                                                     ->with('store_name',$store_name);
    }


    public function rules_service() {
        return [
            'miles' => 'required',
            'service' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ];
    }

    public function messages_service() {
        return [
            'miles.required' => 'กรุณากรอกเลขไมล์ครั้งล่าสุด',
            'service.required' => 'กรุณากรอกสินค้า/บริการ',
            'amount.required' => 'กรุณากรอกจำนวน',
            'unit.required' => 'กรุณากรอกหน่วย',
            'price.required' => 'กรุณากรอกราคา',
        ];
    }
}
