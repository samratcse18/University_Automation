<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
class UserController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|unique:users,email',
            'dept'=>'required',
            'phone'=>'required',
            'student_id'=>'required|unique:users,student_id',
            'password'=>'required|min:8|max:16',
            'cpassword'=>'required|same:password'
            // 'img'=>'required'
        ]);
        $user=new User();
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->email=$request->email;
        $user->dept=$request->dept;
        $user->phone=$request->phone;
        $user->student_id=$request->student_id;
        $user->password=Hash::make($request->password);
        $data=$user->save();
        if ($data) {
            return redirect()->back()->with('success','you Have Successfully registered');
        }
        else {
            return redirect()->back()->with('error',"you Have not Successfully registered");
        }
    }
    public function dologin(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:8|max:16'
        ]);
        $check=$request->only('email','password');
        if (Auth::guard('web')->attempt($check)) {
            return redirect()->route('user.student')->with('success','Welcome to home page');
        }
        else if(Auth::guard('admin')->attempt($check)) {
            return redirect()->route('user.admin')->with('success','Welcome to home page');
        }
        else {
            return redirect()->back()->with('error','Login Failed');
        }
    }
    public function logout(Request $request)
    {
            Auth::guard('web')->logout();
            return redirect('/');
    }
    public function adminlogout()
    {
            Auth::guard('admin')->logout();
            return redirect('/');
    }
    public function home(Request $request)
    {
        if (Auth::guard('web')) {
            return redirect()->route('user.home')->with('success','Welcome to home page');
        }
        else {
            return redirect()->back()->with('error','Login Failed');
        }
    }
}
