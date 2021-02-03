<?php

namespace App\Http\Controllers\AuthMember;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Member;
use App\Salesmember;
use Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

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
        // $this->middleware('auth:member')->except('logout');
    }

    public function showLoginForm()
    {
        Session::put('backUrl', URL::previous());
        return view('authMember.login');
    }

    public function login(Request $request)
    {
        $tel = $request->get('tel');
        $member = Member::where('tel',$tel)->get();

        if(count($member) == 0) {
            $member = Salesmember::where('tel',$tel)->get();
            // dd($member);
            $this->validate($request, [
              'tel' => 'required|exists:sales_members',
            ],[
              'tel.required' => "กรุณากรอกหมายเลขโทรศัพท์",
              'tel.exists' => "หมายเลขโทรศัพท์ไม่ถูกต้อง",
            ]);
    
            $credential = [
              'tel' => $request->tel,
              'password' => $request->password,
              // 'status' => $status,
            ];

            if(Auth::guard('sales_members')->attempt($credential, $request->member)){
              // dd(Redirect::intended());
              // dd(Session::get('backUrl'));
              return Session::get('backUrl') ? redirect( Session::get('backUrl') ) : redirect()->intended(route('member.home'));
            }
            $request->session()->flash('alert-danger', 'หมายเลขโทรศัพท์หรือรหัสผ่านไม่ถูกต้อง');
            return redirect()->back()->withInput($request->only('tel','remember'));
        }

        else {

            $member = Member::where('tel',$tel)->get();
            $this->validate($request, [
              'tel' => 'required|exists:members',
            ],[
              'tel.required' => "กรุณากรอกหมายเลขโทรศัพท์",
              'tel.exists' => "หมายเลขโทรศัพท์ไม่ถูกต้อง",
            ]);
    
            $credential = [
              'tel' => $request->tel,
              'password' => $request->password,
              // 'status' => $status,
            ];
  
            if(Auth::guard('member')->attempt($credential, $request->member)){
              // dd(Session::get('backUrl'));
              return Session::get('backUrl') ? redirect( Session::get('backUrl') ) : redirect()->intended(route('member.home'));
            } 
            $request->session()->flash('alert-danger', 'หมายเลขโทรศัพท์หรือรหัสผ่านไม่ถูกต้อง');
            return redirect()->back()->withInput($request->only('tel','remember'));
        }
    }

    public function loginRegisCard(Request $request) {
        
        $serialnumber = $request->get('serialnumber');
        $member = Member::where('serialnumber',$serialnumber)->first();
        $tel = Member::where('serialnumber',$serialnumber)->value('tel');

        if($member == NULL) {
            $member = Salesmember::where('serialnumber',$serialnumber)->first();
            $tel = Salesmember::where('serialnumber',$serialnumber)->value('tel');

            $this->validate($request, [
              'tel' => 'required|exists:sales_members',
            ],[
              'tel.required' => "กรุณากรอกหมายเลขโทรศัพท์",
              'tel.exists' => "หมายเลขโทรศัพท์ไม่ถูกต้อง",
            ]);

            if($tel == NULL) {
              $member->tel = $request->get('tel');
              $password = $request->get('password');
              $member['password'] = bcrypt($password);
              $member->save();
            }
            elseif($request->get('tel') == $tel) {
              $password = $request->get('password');
              $member['password'] = bcrypt($password);
              $member->save();
            }
            elseif($request->get('tel') != $tel) {
              return redirect()->back();
            }
    
            $credential = [
              'tel' => $request->tel,
              'password' => $request->password,
            ];
            
            if(Auth::guard('sales_members')->attempt($credential, $request->member)){
              return Session::get('backUrl') ? redirect( Session::get('backUrl') ) : redirect()->intended(route('member.home'));
              // return redirect()->intended(route('member.home'));
          }

        } 

        else {
          $this->validate($request, [
            'tel' => 'required|exists:members',
          ],[
            'tel.required' => "กรุณากรอกหมายเลขโทรศัพท์",
            'tel.exists' => "หมายเลขโทรศัพท์ไม่ถูกต้อง",
          ]);
        }

        // $members = Member::where('serialnumber',$serialnumber)->get();
        // foreach($members as $member => $value) {
        //   $id = $value->id;
        //   $member = Member::findOrFail($id);
        //   $member->tel = $request->get('tel');
        //   $member['password'] = bcrypt($member['password']);
        //   $member->save();
        // }

        if($tel == NULL) {
          $member->tel = $request->get('tel');
          $password = $request->get('password');
          $member['password'] = bcrypt($password);
          $member->save();
        }
        elseif($request->get('tel') == $tel) {
          $password = $request->get('password');
          $member['password'] = bcrypt($password);
          $member->save();
        }
        elseif($request->get('tel') != $tel) {
          return redirect()->back();
        }

        $credential = [
          'tel' => $request->tel,
          'password' => $request->password,
        ];
        
        if(Auth::guard('member')->attempt($credential, $request->member)){
        // return redirect()->intended(route('member.home'));
        return Session::get('backUrl') ? redirect( Session::get('backUrl') ) : redirect()->intended(route('member.home'));
      }
      return redirect()->back()->withInput($request->only('tel','remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'member.home' ));
    }

    public function salesLogout(Request $request)
    {
        Auth::guard('sales_members')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'member.home' ));
    }
}
