<?php

namespace App\Http\Controllers\AuthMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Hash;
use App\Member;
use App\Salesmember;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('authMember/passwords/change');
    }

    public function changePassword(Request $request)
    {
       $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
       ]);

       if(Auth::guard('member')->user() != null) {
            $hashedPassword = Auth::guard('member')->user()->password;
            if(Hash::check($request->oldpassword,$hashedPassword)) {
                $member = Member::find(Auth::guard('member')->id());
                $member->password = Hash::make($request->password);
                $member->save();
                Auth::guard('member')->logout();
                return redirect()->route('member.login')->with('successMsg',"เปลี่ยนรหัสผ่านสำเร็จ");
            }else {
                return redirect()->back()->with('errorMsg',"รหัสผ่านไม่ถูกต้อง");
            }
       }
       else {
            $hashedPassword = Auth::guard('sales_members')->user()->password;
            if(Hash::check($request->oldpassword,$hashedPassword)) {
                $member = Salesmember::find(Auth::guard('sales_members')->id());
                $member->password = Hash::make($request->password);
                $member->save();
                Auth::guard('sales_members')->logout();
                return redirect()->route('member.login')->with('successMsg',"เปลี่ยนรหัสผ่านสำเร็จ");
            }else {
                return redirect()->back()->with('errorMsg',"รหัสผ่านไม่ถูกต้อง");
            }
       }
       
    }
}
