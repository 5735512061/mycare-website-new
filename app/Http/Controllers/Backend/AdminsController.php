<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Service;
use App\Payment;
use App\Historyreward;
use App\Statistic;
use App\Store;
use App\Staff;
use App\Reward;
use App\Salesmember;
use App\Salescar;
use App\Salesservice;
use App\Condition;
use App\Salescondition;
use App\Random;

use Auth;

use Carbon\Carbon;
use Validator;

class AdminsController extends Controller
{
    public function member(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::whereIn('membertype',["ลูกค้าทั่วไป","ป้ายเขียว-เหลือง","สมัครผ่านเว็บไซต์"])
                         ->where('serialnumber','!=',NULL)
                         ->groupBy('serialnumber')->orderBy('id','asc')
                         ->paginate($NUM_PAGE);
        $date = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/member/member')->with('NUM_PAGE',$NUM_PAGE)
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
        $member_id = Member::where('serialnumber',$member->serialnumber)->get();
        $member_onlyID= $member_id->map(function($xx) {return $xx->id;});
        $membersames = Service::whereIn('member_id',$member_onlyID)->get();
        $membertype = Member::where('serialnumber',$member->serialnumber)->value('membertype');
        $cntmember = Member::where('serialnumber',$member->serialnumber)->get();
        $scores = Historyreward::whereIn('member_id',$member_onlyID)->get();
        $points = Statistic::whereIn('member_id',$member_onlyID)->get();
        $dateNow = Carbon::now()->format('d/m/Y');
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;

        return view('/backend/admin/member/information-member')->with('NUM_PAGE',$NUM_PAGE)
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

    public function member_editList($id) {
    	$member = Member::findOrFail($id);
    	return view('/backend/admin/member/member-editList')->with('member',$member);
    }

    public function member_updateList(Request $request) {
        $id = $request->get('id');
    	$member = Member::findOrFail($id);
        $member->update($request->all());
    	return redirect()->action('Backend\\AdminsController@member');
    }

    public function member_delete($id) {
        $serialnumber = Member::where('id',$id)->value('serialnumber');
        $idGets = Member::where('serialnumber',$serialnumber)->get();
        $payment = Payment::where('member_id',$id)->delete();
        $statistic = Statistic::where('member_id',$id)->delete();
        $condition = Condition::where('member_id',$id)->delete();
        // $service = Service::where('member_id',$id)->delete();
            foreach($idGets as $idGet => $value) {
                $id = $value->id;
                $service = Service::where('member_id',$id)->delete();
            }
        $member = Member::where('serialnumber',$serialnumber)->delete();
        return back();
    }
    
    public function create_member(Request $request, $id) {
        $member = Member::findOrFail($id);
        return view('/backend/admin/member/create-member')->with('member',$member);
    }

    public function create_memberPost(Request $request) {
        // $validator = Validator::make($request->all(), $this->Createrules(), $this->Createmessages());
            // if($validator->passes()) {
                $member = $request->all();
                $serialnumber = $request->get('serialnumber');
                // $member['password'] = bcrypt($member['tel']);
                $member = Member::create($member);
                $member->serialnumber = $serialnumber;
                $member->save();
                return redirect()->action('Backend\AdminsController@member');
            // }
            // else {
                // return back()->withErrors($validator)->withInput();
            // } 
    }

    public function member_register(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::where('membertype',"สมัครผ่านเว็บไซต์")
                         ->where('serialnumber', '!=', "NULL")
                         ->groupBy('serialnumber')
                         ->orderBy('created_at','asc')->paginate($NUM_PAGE);
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/member/member-register')->with('NUM_PAGE',$NUM_PAGE)
                                                            ->with('page',$page)
                                                            ->with('members',$members);
    }

    public function member_registerWarning(Request $request) {
        $NUM_PAGE = 50;
        $members = Member::where('membertype',"สมัครผ่านเว็บไซต์")
                         ->where('serialnumber',NULL)->paginate($NUM_PAGE);
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/member/member-registerWarning')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('members',$members);
    }

    public function member_information(Request $request, $id) {
        $NUM_PAGE = 15;
        $member = Member::findOrFail($id);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/member/member-information')->with('NUM_PAGE',$NUM_PAGE)
                                                               ->with('page',$page)
                                                               ->with('member',$member);
    }

    public function member_edit($id) {
    	$member = Member::findOrFail($id);
    	return view('/backend/admin/member/member-edit')->with('member',$member);
    }

    public function member_update(Request $request) {
        $id = $request->get('id');
        $serialnumber = $request->get('serialnumber');
    	$member = Member::findOrFail($id);
        $member->update($request->all());
        // $member['password'] = bcrypt($member['tel']);
        $member->serialnumber = $serialnumber;
        $member->save();
        // $comment = $request->get('comment');
        // $payment = Payment::where('member_id',$id);
        // $payment->update(['comment' => $comment]);

        $date = Carbon::now()->format('d/m/Y');
        
        $condition = new Condition;
        $condition->member_id = $id;
        $condition->status = 'limit_1_perDay';
        $condition->date = $date;
        $condition->save();

    	return redirect()->action('Backend\\AdminsController@member_register');
    }

    public function delete_member($id) {
        $payment = Payment::where('member_id',$id)->delete();
        $member = Member::findOrFail($id)->delete();
        return back();
    }

    public function register_alliance() {
        return view('/backend/admin/alliance/register-alliance');
    }

    public function register_alliancePost(Request $request) {
        $store = $request->all();
        $store['password'] = bcrypt($store['tel']);
        $store = Store::create($store);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/store/', $filename);
                $path = 'images/'.$filename;
                $store->image = $filename;
                $store->save();
            }
            if($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/logo', $filename);
                $path = 'images/'.$filename;
                $store->image = $filename;
                $store->save();
            }
            if($request->hasFile('scan')) {
                $image = $request->file('scan');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/scan', $filename);
                $path = 'images/'.$filename;
                $store->image = $filename;
                $store->save();
            }
        return back();
    }

    public function register_staff() {
        return view('/backend/admin/staff/register');
    }

    public function register_staffSubmit(Request $request) {
        $staff = $request->all();
        $staff['password'] = bcrypt($staff['password']);
        $staff['pw'] = $request->get('password');
        $staff['admin_id'] = Auth::user()->id;
        $staff = Staff::create($staff);
        return redirect()->action('Backend\\AdminsController@member');
    }

    public function staff(Request $request) {
        $NUM_PAGE = 15;
        $staffs = Staff::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/staff/staff')->with('NUM_PAGE',$NUM_PAGE)
                                                 ->with('page',$page)
                                                 ->with('staffs',$staffs);
    }

    public function staff_delete($id) {
        $staff = Staff::destroy($id);
        return back();
    }

    public function alliance(Request $request) {
        $NUM_PAGE = 15;
        $stores = Store::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/alliance/alliance')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('stores',$stores);
    }

    public function alliance_edit($id) {
        $alliance = Store::findOrFail($id);
        return view('/backend/admin/alliance/alliance-edit')->with('alliance',$alliance);
    }

    public function alliance_update(Request $request) {
        $id = $request->get('id');
        $alliance = Store::findOrFail($id);
        $alliance['password'] = bcrypt($alliance['tel']);
        $alliance->update($request->all());
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/store/', $filename);
                $path = 'images/'.$filename;
                $alliance = Store::findOrFail($id);
                $alliance->image = $filename;
                $alliance->save();
            }
            if($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/logo/', $filename);
                $path = 'images/'.$filename;
                $alliance = Store::findOrFail($id);
                $alliance->logo = $filename;
                $alliance->save();
            }
            if($request->hasFile('scan')) {
                $image = $request->file('scan');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/scan/', $filename);
                $path = 'images/'.$filename;
                $alliance = Store::findOrFail($id);
                $alliance->scan = $filename;
                $alliance->save();
            }
    	return redirect()->action('Backend\\AdminsController@alliance');
    }

    public function alliance_delete($id) {
        $alliance = Store::destroy($id);
        return back();
    }

    public function reward(Request $request) {
        $NUM_PAGE = 15;
        $rewards = Reward::paginate($NUM_PAGE);     
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/reward/reward')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('rewards',$rewards);
    }

    public function create_reward() {
        return view('/backend/admin/reward/create-reward');
    }

    public function create_rewardPost(Request $request) {
        $reward = $request->all();
        $reward = Reward::create($reward);
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('images/reward/', $filename);
                $path = 'images/'.$filename;
                $reward->image = $filename;
                $reward->save();
            }
        return redirect()->action('Backend\\AdminsController@reward');
    }

    public function reward_edit($id) {
        $reward = Reward::findOrFail($id);
        return view('/backend/admin/reward/reward-edit')->with('reward',$reward);
    }

    public function reward_update(Request $request) {
        $id = $request->get('id');
        $reward = Reward::findOrFail($id);
        $reward->update($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
            $image->move('images/reward/', $filename);
            $path = 'images/'.$filename;
            $reward = Reward::findOrFail($id);
            $reward->image = $filename;
            $reward->save();
        }
        return redirect()->action('Backend\\AdminsController@reward'); 
    }

    public function reward_delete($id) {
        $reward = Reward::destroy($id);
        return back();
    }

    public function statistic(Request $request) {
        $NUM_PAGE = 20;
        $statistics = Statistic::orderBy('created_at','desc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/alliance/statistic')->with('NUM_PAGE',$NUM_PAGE)
                                                        ->with('page',$page)
                                                        ->with('statistics',$statistics);
    }

    public function statistic_delete($id) {
        $statistic = Statistic::findOrFail($id)->delete();
        return back();
    }

    public function summary_statistic(Request $request) {
        $NUM_PAGE = 50;
        $stores = Store::paginate($NUM_PAGE);
        $dateNow = Carbon::now()->format('m');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/alliance/summary-statistic')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('/backend/admin/alliance/summary-statisticID')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('/backend/admin/alliance/summary-statisticMonth')->with('NUM_PAGE',$NUM_PAGE)
                                                                     ->with('page',$page)
                                                                     ->with('statistics',$statistics)
                                                                     ->with('store_name',$store_name);
    }


    public function exchange(Request $request) {
        $NUM_PAGE = 20;
        $exchanges = Historyreward::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/reward/exchange')->with('NUM_PAGE',$NUM_PAGE)
                                                     ->with('page',$page)
                                                     ->with('exchanges',$exchanges);
    }

    public function reward_exchange_update(Request $request,$id) {
        $NUM_PAGE = 20;
        $reward = Historyreward::findOrFail($id);
        $reward->update(['status' => 'แลกรางวัลสำเร็จ']);
        $exchanges = Historyreward::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/reward/exchange')->with('NUM_PAGE',$NUM_PAGE)
                                                     ->with('page',$page)
                                                     ->with('exchanges',$exchanges);
    }

    public function exchange_delete($id) {
        $exchange = Historyreward::destroy($id);
        return back();
    }

    public function service(Request $request, $id) {
        $NUM_PAGE = 10;
        $member_id = Member::findOrFail($id);
        $services = Service::where('member_id',$member_id->id)
                           ->groupBy('date')->orderBy('id','asc')->get();
        $miles = Service::where('member_id',$member_id->id)->groupBy('date')->orderBy('id','desc')->value('miles');
        $members = Member::where('id',$member_id->id)->get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/service/index')->with('NUM_PAGE',$NUM_PAGE)
                                                   ->with('page',$page)
                                                   ->with('services',$services)
                                                   ->with('member_id',$member_id->id)
                                                   ->with('members',$members)
                                                   ->with('miles',$miles);
    }

    public function create_service($id) {
        $member = Member::findOrFail($id);
        return view('/backend/admin/service/create-service')->with('member',$member);
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
            return redirect('/admin/create-service/'.$member_id)->withErrors($validator)->withInput();
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
        return view('/backend/admin/service/service-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('services',$services)
                                                                 ->with('service_date',$service_date)
                                                                 ->with('service_mile',$service_mile)
                                                                 ->with('service_branch',$service_branch);
    }

    public function service_edit($id) {
        $service = Service::findOrFail($id);
        return view('backend/admin/service/service-edit')->with('service',$service);
    }

    public function service_update(Request $request) {
        $id = $request->get('id');
        $service = Service::findOrFail($id);
        $service->update($request->all());
    	return back();
    }

    public function service_delete($id) {
        $service = Service::destroy($id);
        return back();
    }

    public function search_member(Request $request) {
        $NUM_PAGE = 50;
        if($request->get('serialnumber')) {
            $serialnumber = $request->get('serialnumber');
            $id = Member::where('serialnumber',$serialnumber)->value('id');
            $members = Member::where('id',$id)
                             ->whereIn('membertype',["ลูกค้าทั่วไป","ป้ายเขียว-เหลือง","สมัครผ่านเว็บไซต์"])->paginate($NUM_PAGE);
            $count = count($members);
                if($count == 0) {
                    $members = '0';
                }
        }

        if($request->get('tel')) {
            $tel = $request->get('tel');
            $id = Member::where('tel',$tel)->value('id');
            $members = Member::where('id',$id)
                             ->whereIn('membertype',["ลูกค้าทั่วไป","ป้ายเขียว-เหลือง","สมัครผ่านเว็บไซต์"])->paginate($NUM_PAGE);
            $count = count($members);
                if($count == 0) {
                    $members = '0';
                }
        }

        $date = Carbon::now()->format('d/m/Y');
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/member/member')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('/backend/admin/sales/member')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('members',$members)
                                                  ->with('date',$date);
    }

    public function salesRegister() {
        return view('/backend/admin/sales/register');
    }

    public function salesRegisterPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validator->passes()) {
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
                $file->move('images/file/sales', $filename);
                $path = 'images/'.$filename;
                $member->file = $filename;
                $member->save();
            }
            $member->save();

            $request->session()->flash('alert-success', 'สมัครสมาชิกเรียบร้อยแล้วค่ะ กรุณารอการติดต่อกลับ');
            return back();
        }
        else{
                $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
                return redirect('/admin/sales-register')->withErrors($validator)->withInput();   
            }
    }

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

        return view('/backend/admin/sales/information-member')->with('NUM_PAGE',$NUM_PAGE)
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
        return view('/backend/admin/sales/create-sales')->with('member',$member)
                                                        ->with('date',$date);
    }

    public function createSalesPost(Request $request) {
        $member = $request->all();
        $member = Salescar::create($member);
        return redirect()->action('Backend\AdminsController@sales');
    }

    public function serviceSales(Request $request, $id) {
        $NUM_PAGE = 10;
        $member_id = Salescar::findOrFail($id);
        $services = Salesservice::where('car_id',$member_id->id)
                                ->groupBy('date')->orderBy('id','asc')->get();
        $members = Salescar::where('id',$member_id->id)->get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/sales/service/index')->with('NUM_PAGE',$NUM_PAGE)
                                                         ->with('page',$page)
                                                         ->with('services',$services)
                                                         ->with('member_id',$member_id->id)
                                                         ->with('members',$members);
    }

    public function createServiceSales($id) {
        $member = Salescar::findOrFail($id);
        return view('/backend/admin/sales/service/create-service')->with('member',$member);
    }

    public function createServiceSalesPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_service(), $this->messages_service());
        if($validator->passes()) {
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
            $request->session()->flash('alert-success', 'บันทึกข้อมูลสำเร็จ');
            return back();
        }
        else {
            $car_id = $request->get('car_id');
            return redirect('/admin/createService-sales/'.$car_id)->withErrors($validator)->withInput();
        }
    }

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
        return view('/backend/admin/sales/service/service-information')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('services',$services)
                                                                       ->with('service_date',$service_date)
                                                                       ->with('bill_number',$bill_number)
                                                                       ->with('service_branch',$service_branch);
    }

    public function serviceEditSales($id) {
        $service = Salesservice::findOrFail($id);
        return view('backend/admin/sales/service/service-edit')->with('service',$service);
    }

    public function serviceUpdateSales(Request $request) {
        $id = $request->get('id');
        $service = Salesservice::findOrFail($id);
        $service->update($request->all());
    	return back();
    }

    public function serviceDeleteSales($id) {
        $service = Salesservice::destroy($id);
        return back();
    }

    public function salesEdit($id) {
    	$member = Salesmember::findOrFail($id);
    	return view('/backend/admin/sales/sales-edit')->with('member',$member);
    }

    public function salesUpdate(Request $request) {
        $id = $request->get('id');
    	$member = Salesmember::findOrFail($id);
        $member->update($request->all());
        $member->save();
    	return redirect()->action('Backend\\AdminsController@sales');
    }

    public function salesDelete($id) {

        $member_id = Salesmember::where('id',$id)->value('id');
        $image = Salesmember::where('id',$id)->value('file');

        // $image_path = public_path().'/images/file/sales/'.$image;
        // $image_path = '/var/www/html/images/file/sales/'.$image; //in server
        // unlink($image_path);

        $cars = Salescar::where('member_id',$member_id)->get();
            foreach($cars as $car => $value) {
                $service = Salesservice::where('car_id',$value->id)->delete();
            }
        
        $condition = Salescondition::where('member_id',$member_id)->delete();
        $car = Salescar::where('member_id',$member_id)->delete();
        $member = Salesmember::findOrFail($id)->delete();
        return back();
    }

    public function salesRegisterWarning(Request $request) {
        $NUM_PAGE = 50;
        $members = Salesmember::where('serialnumber',NULL)->paginate($NUM_PAGE);
    	$page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/sales/member-registerWarning')->with('NUM_PAGE',$NUM_PAGE)
                                                                  ->with('page',$page)
                                                                  ->with('members',$members);
    }

    public function salesInformation(Request $request, $id) {
        $NUM_PAGE = 15;
        $member = Salesmember::findOrFail($id);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/admin/sales/member-information')->with('NUM_PAGE',$NUM_PAGE)
                                                              ->with('page',$page)
                                                              ->with('member',$member);
    }

    public function confirmCard($id) {
    	$member = Salesmember::findOrFail($id);
    	return view('/backend/admin/sales/member-edit')->with('member',$member);
    }

    public function updateCard(Request $request) {
        $id = $request->get('id');
        $serialnumber = $request->get('serialnumber');
    	$member = Salesmember::findOrFail($id);
        $member->update($request->all());
        $member->serialnumber = $serialnumber;
        $member->save();

        $date = Carbon::now()->format('d/m/Y');
        $condition = new Salescondition;
        $condition->member_id = $id;
        $condition->status = 'limit_1_perDay';
        $condition->date = $date;
        $condition->save();

    	return redirect()->action('Backend\\AdminsController@sales');
    }

    public function deleteRegister($id) {
        $member = Salesmember::findOrFail($id)->delete();
        return back();
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
        return view('backend/admin/sales/member')->with('NUM_PAGE',$NUM_PAGE)
                                                 ->with('page',$page)
                                                 ->with('members',$members)
                                                 ->with('date',$date);
    }

    public function statusMemberForm(Request $request, $id){
        $member = Member::findOrFail($id);
        return view('backend/admin/member/status-member')->with('id',$id)
                                                         ->with('member',$member);
    }

    public function statusMember(Request $request, $id, $status){
        $condition = Condition::where('member_id',$id)->get();
        $date = Carbon::now()->format('d/m/Y');

        if(count($condition) == 0) {
            $condition = new Condition;
            $condition->member_id = $id;
            $condition->status = $status;
            $condition->date = $date;
            $condition->save();
        }else {
            $condition_id = Condition::where('member_id',$id)->value('id');
            $condition = Condition::findOrFail($condition_id);
            $condition['date'] = $date;
            $condition['status'] = $status;
            $condition->update($request->all());
        }
        return redirect('/admin/member');
    }

    public function random(Request $request) {
        $NUM_PAGE = 500;
        $randoms = Random::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/random')->with('NUM_PAGE',$NUM_PAGE)
                                           ->with('page',$page)
                                           ->with('randoms',$randoms);
    }

    public function randomPost(Request $request) {
        $random = rand(1111111111111111,9999999999999999);  
        $random_format = wordwrap($random , 4 , '-' , true );
        $date = Carbon::now()->format('d/m/Y');

        $validator = Validator::make($request->all(), $this->rules_random());
        if($validator->passes()) {
            $random = new Random;
            $random->number = $random_format;
            $random->date = $date;
            $random->save();

            return back();
        } else {
            return back();
        }
    }

    public function rules() {
        return [
            'card_id' => 'required|unique:sales_members',
            'title' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required',
            'address' => 'required',
            'moo' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages() {
        return [
            'card_id.required' => 'กรุณากรอกหมายเลขบัตรประชาชน 13 หลัก',
            'card_id.unique' => 'หมายเลขบัตรประชาชนใช้ในการลงทะเบียนแล้ว',
            'title.required' => 'กรุณาเลือกคำนำหน้า',
            'name.required' => 'กรุณากรอกชื่อ',
            'surname.required' => 'กรุณากรอกนามสกุล',
            'bday.required' => 'กรุณากรอกวันเดือนปีเกิด',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'address.required' => 'กรุณากรอกที่อยู่',
            'moo.required' => 'กรุณากรอกหมู่',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์', 
        ];
    }   

    public function rules_service() {
        return [
            'bill_number' => 'required',
            'service' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ];
    }

    public function messages_service() {
        return [
            'bill_number.required' => 'กรุณากรอกเลขที่บิล',
            'service.required' => 'กรุณากรอกสินค้า/บริการ',
            'amount.required' => 'กรุณากรอกจำนวน',
            'unit.required' => 'กรุณากรอกหน่วย',
            'price.required' => 'กรุณากรอกราคา',
        ];
    }

    public function rules_random() {
        return [
            'number' => 'unique:randoms',
        ];
    }

}
