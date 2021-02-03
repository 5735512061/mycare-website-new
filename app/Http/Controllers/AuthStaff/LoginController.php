<?php

namespace App\Http\Controllers\AuthStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Staff;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff')->except('logout');
    }

    public function showLoginForm() {
        return view('authStaff.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'staff_name' => 'required',
          'password' => 'required|min:6'
        ],[
          'staff_name.required' => "กรุณากรอกชื่อผู้ใช้",
          'password.required' => "กรุณากรอกรหัสผ่าน",
          'password.min' => "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัวอักษร",
        ]);


        $credential = [
          'staff_name' => $request->staff_name,
          'password' =>$request->password,
        ];

       if(Auth::guard('staff')->attempt($credential, $request->member)){
         return redirect()->intended(route('staff.home'));
       }
       
       return redirect()->back()->withInput($request->only('staff_name','remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'staff.login' ));
    }
}
