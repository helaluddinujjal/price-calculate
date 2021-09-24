<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\FlowerCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //admin dashboard
        public function dashboard(){
            $totalCompany=Company::count();
            $totalFType=FlowerCategory::count();
            $totalFlorist=User::count();
            $totalAdmin=Admin::count();
            return view('admin.dashboard',compact('totalCompany','totalFType','totalFlorist','totalAdmin'));
        }
    //admin login
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
               //return $request->all();die;
               if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
                   return redirect('admin/dashboard');
               }else {
                   Session::flash('error_msg','Email or Password is invalid');
                   return redirect()->back();
               }
            }
            if (Auth::guard('admin')->check()) {
                return redirect('admin/dashboard');
            }
            return view('admin.login');
        }
        
        //admin logout
        public function logout(){
            Session::forget('page');
            Auth::guard('admin')->logout();
            return redirect('admin');
        }

    //account settings
    public function accountSettings(Request $request){
        Session::forget('page');
        Session::put('page','admin-account-settings');
        $adminDetails=Admin::where('email',Auth::guard('admin')->user()->email)->first();
        if ($request->isMethod('post')) {
            $rule=[
                'name'=>'required|min:3',
                'email' => 'required|email|unique:admins,email,'.$adminDetails->id,
                'password'=>'sometimes|min:6|confirmed'
            ];
            $customMsg=[
                'name.required'=>"Name must not be empty",
                'name.regex'=>"Name formate invalid.only latter and . will allow",
            ];
            $this->validate($request,$rule,$customMsg);
            $admin=Admin::where('email',Auth::guard('admin')->user()->email)->first();
            if (!empty($request->confirm_pass)|!empty($request->new_pass)) {
                    if ($request->confirm_pass==$request->new_pass) {
                        $admin->password=bcrypt($request->new_pass);
                    }else {
                        Session::flash('error_msg','Confirm password is not match');
                        return redirect()->back();
                    }
            }
                $admin->name=$request->name;
                $admin->email=$request->email;
                $admin->save();
            Session::flash('success_msg','Admin Details has been updated');
            return redirect()->back();
            
        }
        return view('admin.admins.settings_details')->with(compact('adminDetails'));
    }

    public function addAdmin(Request $request){
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
            $admins=new Admin();
            $admins->name=$request->name;
            $admins->email=$request->email;
            $admins->password=bcrypt($request->password);
            $admins->save();
            Session::flash('success_msg','Admin Account has been Created');
            return redirect('admin/admins/');
        }
        return view('admin.admins.add-admin');
    }
    public function admins(){
        Session::forget('page');
        Session::put('page','admin-list');
        $admins=Admin::get();
        return view('admin.admins.admins',compact('admins'));
    }
    public function deleteAdmin($id){
        Admin::where('id',$id)->delete();
        Session::flash('success_msg','Admin account has been deleted successfully.');
        return redirect('/admin/admins');
    }
    public function deleteUser($id){
        User::where('id',$id)->delete();
        Session::flash('success_msg','User account has been deleted successfully.');
        return redirect('/admin/users');
    }

    public function users(){
        $users=User::get();
        return view('admin.users',compact('users'));
    }

    public function updateUserStatus(Request $request){
        if ($request->ajax()) {
            $data=$request->all();
            if ($data['status']=='Active') {
                $status=0;
            }else{
                $status=1;
            }
            User::where('id',$data['id'])->update(['status'=>$status]);
            return response()->json(['get_id'=>$data['id'],'status'=>$status]);

        }
    }
    public function forgetPassword(Request $request){
        if ($request->isMethod('post')) {
            $emailCount=Admin::where('email',$request->email)->count();
            if ($emailCount==0) {
                Session::flash('error_msg',"Email does not exists!");
                return redirect()->back();
            } else {
                $adminDetals=Admin::select('name')->where('email',$request->email)->first();
                $randPass=Str::random(8);
                Admin::where('email',$request->email)->update(['password'=>bcrypt($randPass)]);
                $email=$request->email;
                $name=$adminDetals->name;
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
        
        return view('admin.admins.forget-password');
    }

}
