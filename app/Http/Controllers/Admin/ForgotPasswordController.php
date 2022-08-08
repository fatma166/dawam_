<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ApiCode;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Models\Attendance;

use App\Models\User;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Mail; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function form_email($subdomain){
        
          
          return view('auth.sendemail');
    }
    public function forgot($subdomain,Request $request) {
       /* $credentials = request()->validate(['email' => 'required|email']);
       // print_r($credentials);exit;
        Password::sendResetLink($credentials);

          return $this->respondWithMessage('Reset password link sent on your email id.');*/
          //echo $request->email; exit;
         //  $request->validate(['email' => 'required|email']);
         $user = DB::table('users')->where('email', '=', $request->email)->get();
           // print_r($user);
        
        //Check if the user exists
        if (count($user) !=0) {
      
          $token = Str::random(64);
    
          DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
    
          Mail::send('auth.verify', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject(__('trans.Reset Password Notification'));    
          });
          //exit;
    
          return back()->with('success', __('trans.We have e-mailed your password reset link!'));
          }
          
            
            return back()->with('error', __('trans.User does not exist'));
    
  }
   // public function view_reset()
public function getPassword($subdomain,$token) { 

     return view('auth.reset_password', ['token' => $token]);
  }


  public function reset($subdomain,Request $request) {
  

  $request->validate([
      'email' => 'required|email',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

  ]);

  $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

  if(!$updatePassword)
      return back()->withInput()->with('error', 'Invalid token!');

    $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return redirect('/login')->with('message', 'Your password has been changed!');

  

    }
    public function get_settings(){
    $settings= DB::table('settings')->where('Group','Site')->get();
            $set=array();
        foreach($settings as $setting){
            if($setting->key=='site.title') $set['title']=$setting->value;
               if($setting->key=='site.description') $set['desc']=$setting->value;
                  if($setting->key=='site.logo') $set['logo']=$setting->value;
                     if($setting->key=='site.phone') $set['phone']=$setting->value;
                        if($setting->key=='site.email') $set['email']=$setting->value;
        }
    return($set);
    
}
}