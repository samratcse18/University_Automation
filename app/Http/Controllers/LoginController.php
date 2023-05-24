<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Bank;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function dologin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:16'
        ],
        [
            'email.required'=>'Email is Required',
            'email.email'=>'Please Enter Valid Email',
            'password.required'=>'Password is Required',
            'password.min'=>'Password Minimum 8 Characters',
            'password.max'=>'Password Maximum 16 Characters',
        ]
        );

        $check=$request->only('email','password');
        if (Auth::guard('student')->attempt($check)) {
                if ((Auth::guard('student')->user()->verify)=='active') {
                    return redirect()->route('user.student')->with('success','Welcome to home page');
                }
                else {
                    $details['roll'] = Auth::guard('student')->user()->admission_roll;
                    \Mail::to($request->email)->send(new \App\Mail\TestMail($details));
                    return redirect()->back()->with('error','Please Check Your Email & Verify Account');
                }
        }
        else if(Auth::guard('admin')->attempt($check)) {
            return redirect()->route('user.admin')->with('success','Welcome to home page');
        }
        else if(Auth::guard('bank')->attempt($check)) {
            return redirect()->route('user.bank')->with('success','Welcome to home page');
        }
        else {
            return redirect()->back()->with('error','Your Email Or Password Incorrect');
        }
    }

    public function forgotPasswordData(Request $request)
    {
        $request->validate([
            'email'=>'required',
        ]);
        
        if ($user=Student::where('email',$request->email)->first()) {
            $data = [
                'name' => 'BSMRSTU',
                'email' => $request->email,
                'id'=>$user->id,
                'model'=>'student',
                ];
            Mail::send('resetPasswordEmail', $data, function ($message) use($data) {
                // $message->from('sender@example.com', 'Reset Password');
                $message->to($data['email']);
                $message->subject('Reset Password');
            });
            return redirect()->route('user.login')->with('success','Please Check Your Email');
        }
        else if($user=Admin::where('email',$request->email)->first()) {
            $data = [
                'name' => 'BSMRSTU',
                'email' => $request->email,
                'id'=>$user->id,
                'model'=>'admin',
                ];
            Mail::send('resetPasswordEmail', $data, function ($message) use($data) {
                $message->from('sender@example.com', 'Reset Password');
                $message->to($data['email']);
                $message->subject('Reset Password');
            });
            return redirect()->route('user.login')->with('success','Please Check Your Email');
        }
        else if($user=Bank::where('email',$request->email)->first()) {
            $data = [
                'name' => 'BSMRSTU',
                'email' => $request->email,
                'id'=>$user->id,
                'model'=>'bank',
                ];
            Mail::send('resetPasswordEmail', $data, function ($message) use($data) {
                $message->from('sender@example.com', 'Reset Password');
                $message->to($data['email']);
                $message->subject('Reset Password');
            });
            return redirect()->route('user.login')->with('success','Please Check Your Email');
        }
        else {
            return redirect()->back()->with('error','Your Email Not Found');
        }
    }

    public function resetPassword($id,$model)
    {
        $data=$id;
        return view('resetPasswordView', compact('data','model'));
    }

    public function resetPasswordData(Request $request)
    {
        $id=$request->id;
        $model=$request->model;
        $request->validate([
            'email'=>'required|email',
            'password' => 'required|min:8|max:16',
            'cpassword' => 'required|same:password',
        ]);
        if ($model=='student') {
            $user=Student::find($id);
            if ($user->email==$request->email) {
                $update=$user->update([
                    'password'=>Hash::make($request->password),
                ]);
                if ($update) {
                    return redirect()->route('user.login')->with('success','Successfully Reset password');
                }
                else{
                    return redirect()->back()->with('error','Password Not Reset');
                }
            }
            else {
                return redirect()->back()->with('error','Your Email is Not Correct');
            }
        }
        elseif ($model=='admin') {
            $user=Admin::find($id);
            if ($user->email==$request->email) {
                $update=$user->update([
                    'password'=>Hash::make($request->password),
                ]);
                if ($update) {
                    return redirect()->route('user.login')->with('success','Successfully Reset password');
                }
                else{
                    return redirect()->back()->with('error','Password Not Reset');
                }
            }
            else {
                return redirect()->back()->with('error','Your Email is Not Correct');
            }
        }
        elseif ($model=='bank') {
            $user=Bank::find($id);
            if ($user->email==$request->email) {
                $update=$user->update([
                    'password'=>Hash::make($request->password),
                ]);
                if ($update) {
                    return redirect()->route('user.login')->with('success','Successfully Reset password');
                }
                else{
                    return redirect()->back()->with('error','Password Not Reset');
                }
            }
            else {
                return redirect()->back()->with('error','Your Email is Not Correct');
            }
        }
    }
}
