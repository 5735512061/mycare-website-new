<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Payment;
use App\Service;
use App\Historyreward;
use App\Statistic;
use App\Salesmember;
use App\Salesservice;
use App\Salescar;

use Validator;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class MembersController extends Controller
{
    public function register() {
        return view('frontend/member/register');
    }

    public function registerPost(Request $request) {
        // dd($request->slip);
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
            $education = $request->get('education');
            $career = $request->get('career');
            $salary = $request->get('salary');
            $password = null;
            $membertype = $request->get('membertype');
            $status = $request->get('status');
            $condition = $request->get('condition');

            $slip = $request->get('slip');
            // $bank = $request->get('bank');
            // $money = $request->get('money');
            // $payday = $request->get('payday');
            // $time = $request->get('time');
            

            $member = new Member;
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
            $member->status = $status;
            $member->membertype = $membertype;
            $member->password = $password;
            $member->condition = $condition;
            $member->education = $education;
            $member->career = $career;
            $member->salary = $salary;
            $member->save();

            $payment = new Payment;
            $member_id = Member::orderBy('created_at','desc')->first();
            $payment->member_id = $member_id->id;
            $payment->card_id = $card_id;
            // $payment->bank = $bank;
            // $payment->money = "799";
            // $payment->payday = $payday;
            // $payment->time = $time;
            if($request->hasFile('slip')) {
                $slip = $request->file('slip');
                $filename = md5(($slip->getClientOriginalName(). time()) . time()) . "_o." . $slip->getClientOriginalExtension();
                $slip->move('images/slip/', $filename);
                $path = 'images/'.$filename;
                $payment->slip = $filename;
                $payment->save();
            }
            $payment->save();

            $request->session()->flash('alert-success', 'สมัครสมาชิกเรียบร้อยแล้วค่ะ กรุณารอการติดต่อกลับ');
            return back();
        }
        else{
                $request->session()->flash('alert-danger', 'สมัครสมาชิกไม่สำเร็จ กรุณากรอกข้อมูลให้ถูกต้องครบถ้วน');
                return redirect('/member/register')->withErrors($validator)->withInput();   
            }
    }

    public function registerCard() {
        return view('frontend/member/register-card');
    }

    public function registerCardPost(Request $request) {
        $serialnumber = $request->get('serialnumber');
        $member = Member::where('serialnumber',$serialnumber)->get();
        $password = Member::where('serialnumber',$serialnumber)->value('password');

        if(count($member) == NULL) {
            $member = Salesmember::where('serialnumber',$serialnumber)->get();
            $password = Salesmember::where('serialnumber',$serialnumber)->value('password');
        }
        
        
            if(count($member) > 0 && $password == NULL) {
                return View::make('frontend/member/registerCardForm')->with('serialnumber', $serialnumber);
            }
            if($password != NULL) {
                $request->session()->flash('alert-danger', 'หมายเลขบัตรสมาชิกนี้เคยลงทะเบียนแล้ว กรุณาเข้าสู่ระบบ');
                return redirect('/member/register-card');
            }
            else {
                $request->session()->flash('alert-danger', 'หมายเลขบัตรสมาชิกไม่ถูกต้อง');
                return redirect('/member/register-card');
            }
    }

    public function registerCardForm() {
        $serialnumber = Session::get('serialnumber');
        Session::put('serialnumber',$serialnumber);
        return view('frontend/member/registerCardForm')->with('serialnumber', $serialnumber);
    }

    public function profile() {
        if(Auth::guard('member')->user() != null) {
            $id = Auth::guard('member')->user()->id;
            $member = Member::findOrFail($id);
            $member_id = Member::where('serialnumber',$member->serialnumber)->get();
            $member_onlyID= $member_id->map(function($xx) {return $xx->id;});
            $membersames = Service::whereIn('member_id',$member_onlyID)->get();
            $scores = Historyreward::whereIn('member_id',$member_onlyID)->get();
            $points = Statistic::whereIn('member_id',$member_onlyID)->get();
            $dateNow = Carbon::now()->format('d/m/Y');
            return view('frontend/member/account/profile')->with('member',$member)
                                                          ->with('dateNow',$dateNow)
                                                          ->with('membersames',$membersames)
                                                          ->with('points',$points)
                                                          ->with('scores',$scores);
        }else {
            $id = Auth::guard('sales_members')->user()->id;
            $member = Salesmember::findOrFail($id);

            // คิดจากตารางสมาชิกเซลล์
            $member_id = Salesmember::where('id',$member->id)->get();
            $member_onlyID= $member_id->map(function($xx) {return $xx->id;});

            // คิดจากตารางรถ
            $car_id = Salescar::where('member_id',$member->id)->get();
            $car_onlyID= $car_id->map(function($xx) {return $xx->id;});

            $membersames = Salesservice::whereIn('car_id',$car_onlyID)->get();

            $scores = Historyreward::whereIn('sales_id',$member_onlyID)->get();
            $points = Statistic::whereIn('sales_id',$member_onlyID)->get();
            
            $dateNow = Carbon::now()->format('d/m/Y');
            return view('frontend/member/account-sales/profile')->with('member',$member)
                                                                ->with('dateNow',$dateNow)
                                                                ->with('membersames',$membersames)
                                                                ->with('points',$points)
                                                                ->with('scores',$scores);
        }
        
    }


    public function profileChange(){
        if(Auth::guard('member')->user() != null) {
            $member = Auth::guard('member')->user();
            return view('frontend/member/account/profile-change')->with('member',$member);
        }else{
            $member = Auth::guard('sales_members')->user();
            return view('frontend/member/account-sales/profile-change')->with('member',$member);
        }
    }

    public function profileUpdate(Request $request) {
        $id = $request->get('id');
    	if(Auth::guard('member')->user() != null) {
            $member = Member::findOrFail($id);
            $member->update($request->all());
    	    return redirect()->action('Frontend\\MembersController@profile');
        }else {
            $member = Salesmember::findOrFail($id);
            $member->update($request->all());
    	    return redirect()->action('Frontend\\MembersController@profile');
        }
    }

    public function telChange(){
        if(Auth::guard('member')->user() != null) {
            $member = Auth::guard('member')->user();
        }else {
            $member = Auth::guard('sales_members')->user();
        }
        return view('frontend/member/account/tel-change')->with('member',$member);
    }

    public function telUpdate(Request $request) {
        $id = $request->get('id');
        if(Auth::guard('member')->user() != null) {
            $member = Member::findOrFail($id);
            $member->update($request->all());
    	    return redirect()->action('Frontend\\MembersController@profile');
        }else {
            $member = Salesmember::findOrFail($id);
            $member->update($request->all());
    	    return redirect()->action('Frontend\\MembersController@profile');
        }
        
    }

    public function rewardHistory(Request $request, $id) {
        $NUM_PAGE = 20;
        $reward_exchanges = Historyreward::where('member_id',$id)->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/member/account/reward-history')->with('reward_exchanges',$reward_exchanges)
                                                             ->with('NUM_PAGE',$NUM_PAGE)
                                                             ->with('page',$page);
    }
    
    public function rules() {
        return [
            'card_id' => 'required|unique:members',
            'title' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'bday' => 'required',
            'tel' => 'required|unique:members',
            'address' => 'required',
            'moo' => 'required',
            'district' => 'required',
            'amphoe' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
            // 'money' => 'required',
            // 'payday' => 'required',
            // 'time' => 'required',
            'slip' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'condition' => 'accepted',
            'education' => 'required',
            'career' => 'required',
            'salary' => 'required',
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
            'tel.unique' => 'เบอร์โทรศัพท์ใช้ในการลงทะเบียนแล้ว',
            'address.required' => 'กรุณากรอกที่อยู่',
            'moo.required' => 'กรุณากรอกหมู่',
            'district.required' => 'กรุณากรอกตำบล',
            'amphoe.required' => 'กรุณากรอกอำเภอ',
            'province.required' => 'กรุณากรอกจังหวัด',
            'zipcode.required' => 'กรุณากรอกรหัสไปรษณีย์',
            // 'money.required' => 'กรุณากรอกจำนวนเงินที่ชำระ',
            // 'payday.required' => 'กรุณากรอกวัน/เดือน/ปีที่ชำระ',
            // 'time.required' => 'กรุณากรอกเวลาที่ชำระ',
            'slip.required' => 'กรุณาแนบหลักฐานการโอน',
            // 'condition.accepted' => 'กรุณาอ่านเงื่อนไขและกดยอมรับเงื่อนไข',
            'education.required' => 'กรุณาเลือกหัวข้อการศึกษา',
            'salary.required' => 'กรุณาเลือกหัวข้อรายได้บุคคลต่อเดือน',
            'career.required' => 'กรุณาเลือกหัวข้อประกอบอาชีพ'
        ];
    }   


}
