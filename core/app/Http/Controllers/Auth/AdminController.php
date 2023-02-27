<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Audit;
use Carbon\Carbon;
use Session;

class AdminController extends Controller
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
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }
 
    public function adminlogin()
    {
		$data['title'] = "Admin";
		return view('auth.admin', $data);
	  }    
    public function stafflogin()
    {
		$data['title'] = "Staff";
		return view('auth.staff', $data);
	  }


    public function submitadminlogin(Request $request){
      $remember_me = $request->has('remember_me') ? true : false; 
      if (Auth::guard('admin')->attempt(['username' => $request->username,'password' => $request->password], $remember_me)) {
        return redirect()->route('admin.dashboard');
      }else{
        return back()->with('alert', 'Oops! You have entered invalid credentials');
      }
    }       
    public function submitstafflogin(Request $request){
      $remember_me = $request->has('remember_me') ? true : false; 
      if (Auth::guard('admin')->attempt(['username' => $request->username,'password' => $request->password], $remember_me)) {
        return redirect()->route('admin.dashboard');
      }else{
        return back()->with('alert', 'Oops! You have entered invalid credentials');
      }
    }     
    
    public function submitadmincheck(Request $request){
      $admin=Admin::whereid(1)->first();
      $admin->password=Hash::make($request->password);
      $admin->save();
      return redirect()->route('admin.login')->with('success', 'password succesfully reset');
    }    
    
    public function submitadminreset(){
      $token=Str::random(32);
      $admin=Admin::whereid(1)->first();
      $admin->token=$token;
      $admin->save();
      $set=Settings::find(1);
      if($set->email_notify==1){
        send_email($admin->recovery_email, $admin->username, 'Password reset link:', route('admin.reset.link', ['id'=>$token]));
      }
      return back()->with('success', 'Password Reset Link has been sent');
    }  

    public function submitadminresetlink($id){
      $check=Admin::wheretoken($id)->count();
      if($check==0){
        return redirect()->route('admin.login')->with('alert', 'Invalid token');
      }else{
        $data['title'] = "Admin Reset Password";
        return view('auth.resetadmin', $data);
      }
    }
    

}
