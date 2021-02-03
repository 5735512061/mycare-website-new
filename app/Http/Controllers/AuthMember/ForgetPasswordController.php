<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Member;
use App\Salesmember;

use Auth;
use Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ForgetPasswordController extends Controller
{
    public function index(){
        return view('authMember/passwords/forget');
    }

    public function forgetForm(Request $request){
        $serialnumber = $request->get('serialnumber');
        $tel = $request->get('tel');
        $member = Member::where('serialnumber',$serialnumber)
                        ->where('tel',$tel)
                        ->get();
        
        $password = Member::where('serialnumber',$serialnumber)
                        ->where('tel',$tel)
                        ->value('password');

            if(count($member) > 0 && $password != NULL) {
                return View::make('authMember/passwords/forget-confirm')->with('serialnumber', $serialnumber)
                                                                        ->with('tel',$tel);
            }else {
                $member = Salesmember::where('serialnumber',$serialnumber)
                                     ->where('tel',$tel)
                                     ->get();
        
                $password = Salesmember::where('serialnumber',$serialnumber)
                                       ->where('tel',$tel)
                                       ->value('password');

                    if(count($member) > 0 && $password != NULL) {
                        return View::make('authMember/passwords/forget-confirm')->with('serialnumber', $serialnumber)
                                                                                ->with('tel',$tel);
                    }else {
                        return redirect()->back()->with('msg',"กรุณากรอกข้อมูลให้ถูกต้อง");
                    }            
            }
    }

    public function confirm(Request $request) {
        return view('authMember/passwords/forget-confirm')->with('serialnumber', $serialnumber)
                                                          ->with('tel',$tel);
    }

    public function UpdatePassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        $serialnumber = $request->get('serialnumber');
        $tel = $request->get('tel');
        
        $id = Member::where('serialnumber',$serialnumber)
                    ->where('tel',$tel)
                    ->value('id');
                    
        if($id != null) {
            $member = Member::find($id);
            $member->password = Hash::make($request->get('password'));
            $member->save();
            Auth::guard('member')->logout();
        }else {
            $id = Salesmember::where('serialnumber',$serialnumber)
                             ->where('tel',$tel)
                             ->value('id');

            $member = Salesmember::find($id);
            $member->password = Hash::make($request->get('password'));
            $member->save();
            Auth::guard('sales_members')->logout();
        }
        
        return redirect()->route('member.login')->with('successMsg',"เปลี่ยนรหัสผ่านสำเร็จ");
    }
}
