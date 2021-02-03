<?php

namespace App\Http\Controllers\AuthStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest:store')->except('logout');
    }

    public function showLoginForm()
    {
        return view('authStore.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'tel' => 'required|exists:stores',
        ],[
          'tel.required' => "กรุณากรอกหมายเลขพันธมิตร",
          'tel.exists' => "หมายเลขพันธมิตรไม่ถูกต้อง",
        ]);

        $credential = [
          'tel' => $request->tel,
          'password' => $request->tel,
        ];

       if(Auth::guard('store')->attempt($credential, $request->member)){
         return redirect()->intended(route('store.home'));
       }
       
       return redirect()->back()->withInput($request->only('tel','remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('store')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'store.login' ));
    }
}
