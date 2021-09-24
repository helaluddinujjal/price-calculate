<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //user login
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $rule=[
                'email'=>'required|email|max:255',
                'password'=>'required',
            ];
            $customMsg=[
                'email.required'=>"Email must not be empty",
                'email.email'=>"Email must be valid",
                'email.max'=>"Email length will be max 255 words",
                'password.required'=>"Password must not be empty",
            ];
            $this->validate($request,$rule,$customMsg);
          // return $request->all();die;
           if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
               $user=User::where('email',Auth::user()->email)->first();
                $name=$user->name;
               if ($user->is_varify!=1) {
                   //Auth::logout();
                   return view('frontend.users.email-varify',compact('name'));
               }
               if ($user->status!=1) {
                   Auth::logout();
                   return view('frontend.users.disable-account',compact('name'));
               }
               return redirect('home');
           }else { 
               Session::flash('error_msg','Email or Password is invalid');
               return redirect()->back();
           }
        }
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('frontend.login');
    }
    
    //user logout
    public function logout(){
        Session::forget('page');
        Auth::logout();
        return redirect('/');
    }

        //account settings
        public function accountSettings(Request $request){
            Session::forget('page');
            Session::put('page','account-settings');
            $userDetails=User::where('email',Auth::user()->email)->first();
            if ($request->isMethod('post')) {
                $rule=[
                    'name'=>'required|regex:/^[A-Za-z. ]+$/',
                    'email' => 'required|unique:users,email,'.$userDetails->id,
                    'password'=>'sometimes|min:6|confirmed'
                ];
                $customMsg=[
                    'name.required'=>"Name must not be empty",
                    'name.regex'=>"Name formate invalid.only latter and . will allow",
                ];
                $this->validate($request,$rule,$customMsg);
                $user=user::where('email',Auth::user()->email)->first();
                if (!empty($request->confirm_pass)|!empty($request->new_pass)) {
                        if ($request->confirm_pass==$request->new_pass) {
                            $user->password=bcrypt($request->new_pass);
                        }else {
                            Session::flash('error_msg','Confirm password is not match');
                            return redirect()->back();
                        }
                }
                    $user->name=$request->name;
                    $user->email=$request->email;
                    $user->save();
                Session::flash('success_msg','User Details has been updated');
                return redirect()->back();
                
            }
            return view('frontend.settings_details')->with(compact('userDetails'));
        }

        public function registration(Request $request){
            if ($request->isMethod('post')) {
                $rule=[
                    'name'=>'required|min:3',
                    'email' => 'required|email|unique:admins,email,',
                    'password'=>'required|min:6'
                ];
                $customMsg=[
                    'name.required'=>"Name must not be empty",
                    'name.regex'=>"Name formate invalid.only latter and . will allow",
                ];
                $this->validate($request,$rule,$customMsg);
                $users=new User();
                $users->name=$request->name;
                $users->email=$request->email;
                $users->status=1;
                $users->is_varify=0;
                $users->password=bcrypt($request->password);
                $users->save();
                $email=$request->email;
                $name=$request->name;
                $appName=str_replace('_','-',config('app.name'));
                $code=base64_encode($email);
                $msg="Please click on bellow link to activate your account";
                $subject="Confirm Your ".str_replace('_','-',config('app.name'))." Account";
                $message=['name'=>$name,'email'=>$email,'msg'=>$msg,'appName'=>$appName,'code'=>$code];
                Mail::send('mail.register-confirm', $message, function ($message) use($email,$subject,$name){
                    $message->to($email, $name)->subject($subject);
                });
                // Session::flash('success_msg','Florist Account has been Registerd.Please check your email and activated your account by clicking on the link.');
                return view('frontend.users.registration-success',compact('name'));
            }
            return view('frontend.users.register');
        }
        
        public function EmailVarifyAgain(){
                $user=Auth::user()->name;
                $email=Auth::user()->email;
                $name=Auth::user()->name;
                $appName=str_replace('_','-',config('app.name'));
                $code=base64_encode($email);
                $msg="Please click on bellow link to activate your account";
                $subject="Confirm Your ".str_replace('_','-',config('app.name'))." Account";
                $message=['name'=>$name,'email'=>$email,'msg'=>$msg,'appName'=>$appName,'code'=>$code];
                Mail::send('mail.register-confirm', $message, function ($message) use($email,$subject,$name){
                    $message->to($email, $name)->subject($subject);
                });
                 Session::flash('success_msg','Email has been sent. Please varify your account.');
                return redirect()->back();
        }
        public function userConfirmEmail($email){
            $email=base64_decode($email);
            $userCount=User::where('email',$email)->count();
            if ($userCount>0) {
                $user=User::where('email',$email)->first();
            if ($user->is_varify==1) {
                Session::flash('warning_msg',"Your email account already activated! Please login.");
                return redirect('/');
            }else{
                User::where('email',$user->email)->update(['is_varify'=>1]);
                Session::flash('success_msg',"Your email account is activated. You can login now.");
                return redirect('/');
            }
            } else {
                abort(404);
            }
            
            
        }
        public function forgetPassword(Request $request){
            if ($request->isMethod('post')) {
              
                $emailCount=User::where('email',$request->email)->count();
                if ($emailCount==0) {
                    Session::flash('error_msg',"Email does not exists!");
                    return redirect()->back();
                } else {
                    $userDetals=User::select('name')->where('email',$request->email)->first();
                    $randPass=Str::random(8);
                    User::where('email',$request->email)->update(['password'=>bcrypt($randPass)]);
                    $email=$request->email;
                    $name=$userDetals->name;
                    $msg="You have requested to recover your password.Your new password is as bellow :-";
                    $appName=str_replace('_','-',config('app.name'));
                    $data=[
                        'name'=>$name,'password'=>$randPass,'appName'=>$appName,'msg'=>$msg
                    ];
                    $subj="New password-".$appName=str_replace('_','-',config('app.name'));
                    Mail::send('mail.forget-password', $data, function ($message) use($email,$name,$subj){
                        $message->to($email, $name)->subject($subj);
                    });
                    Session::flash('success_msg',"Please check your email for new password.");
                    return redirect()->back();
                }
            }
            
            return view('frontend.users.forget-password');
        }

    public function check(){

        return view('frontend.users.email-varify');
    }
}
