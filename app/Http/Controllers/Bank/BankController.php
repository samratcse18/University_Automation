<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Bank;
use App\Models\Admission;
use App\Models\Exam;
use App\Models\Session;
use App\Models\Student;
use App\Models\HallTotalStudent;
use App\Exports\AdmissionExport;
use DB;
use Hash;
use Excel;
class BankController extends Controller
{
    public function logout(Request $request)
    {
            Auth::guard('bank')->logout();
            return redirect('/');
    }
    public function scanBarcode(Request $request)
    {
        $barcode=substr($request->barcode, 0,3);
        if ($barcode==100) {
            $student=Exam::where('token',$request->barcode)->first();
            if ($student && $student->status=='pending') {
                $update=Exam::where('token',$request->barcode)->update(['status'=>'active']);
                return redirect()->route('bank.scan')->with('status','active');
            }
            else{
                return redirect()->route('bank.scan')->with('error','deactive');
            }
        }
        elseif ($barcode==300) {
            $student=HallTotalStudent::where('token',$request->barcode)->first();
            if ($student && $student->status=='active') {
                $data=HallTotalStudent::where('token',$request->barcode)->update([
                    'status'=>'residential',
                    'token'=>'300'.time(),
                    'payment'=>now(),
                ]);
                return redirect()->route('bank.scan')->with('status','active');
            }
            elseif ($student && $student->status=='residential') {
                $data=HallTotalStudent::where('token',$request->barcode)->update([
                    'token'=>'300'.time(),
                    'payment'=>now(),
                ]);
                return redirect()->route('bank.scan')->with('status','active');
            }
            else{
                return redirect()->route('bank.scan')->with('error','deactive');
            }
        }
        else {
            $student=Admission::where('token',$request->barcode)->first();
            if ($student && $student->status=='pending') {
                $update=Admission::where('token',$request->barcode)->update(['status'=>'active']);
                if ($student->Semester=='1st Year-1st Semester') {
                    $st=Student::where('admission_roll',$student->RollNumber)->update([
                        'current_semester'=>$student->Semester,
                    ]);
                }
                else {
                    $st=Student::where('student_id',$student->RollNumber)->update([
                        'current_semester'=>$student->Semester,
                    ]);
                }
                return redirect()->route('bank.scan')->with('status','active');
            }
            else{
                return redirect()->route('bank.scan')->with('error','deactive');
            }
        }
    }

    public function bankStatement()
    {
        $year=Session::all();
        return view('bankStatement', compact('year'));
    }

    public function getStatementData(Request $request)
    {
        $session=$request->Session;
        $select=Admission::where([['Session', '=', $session],['status', '=', 'active']])->get();
        return redirect()->route('bank.statement')->with('data',$select);

    }
    public function exportExcel(Request $request)
    {
        return Excel::download(new AdmissionExport($request->session),'AdmissionDataExport.xlsx');
    }

    public function bankProfileUpdate()
    {
        return view('bankProfile');
    }

    public function bankProfileUpdateData(Request $request)
    {
        $user = Auth::guard('bank')->user();
        if ($request->password) {
            $request->validate([
                "cpassword"=>"same:password"
            ]);
        }
        if ($user->email==$request->Email) {
            $request->validate([
            "FirstName" => "required",
            "LastName" => "required",
            "Email" => "required",
            "Phone" => "required",
            "city" => "required",
            "district" => "required",
            "street" => "required",
            ]);
        }
        else {
            $request->validate([
            "FirstName" => "required",
            "LastName" => "required",
            "Email" => "required|unique:banks,email",
            "Phone" => "required",
            "city" => "required",
            "district" => "required",
            "street" => "required",
            ]);
        }

        if ($request->password) {
            $data=Bank::where('id', $user->id)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "phone" => $request->Phone,
                "city" => $request->city,
                "district" => $request->district,
                "street" => $request->street,
                "street" => $request->street,
                "password" => Hash::make($request->password),
            ]);
            if ($data) {
                return redirect()->route('user.bank')->with('success', 'Successfully Update Profile');
            }
        }
        else {
            $data=Bank::where('id', $user->id)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "phone" => $request->Phone,
                "city" => $request->city,
                "district" => $request->district,
                "street" => $request->street,
                "street" => $request->street,
            ]);
            if ($data) {
                return redirect()->route('user.bank')->with('success', 'Successfully Update Profile');
            }
        }

    }

    public function officeStaff()
    {
        $data=Bank::role('bank_office')->get();
        return view('bankOfficeStaff',compact('data'));
    }

    public function bankOfficeStaffCreate(Request $request)
    {
        $request->validate([
            "First_Name" => "required",
            "Last_Name" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
            "password" => "required|min:8|max:16",
            "cpassword" => "required|same:password",
        ]);
        $user=Bank::where('email', $request->Email)->role('bank_office')->first();
        if ($user) {
            return redirect()->back()->with('err', "This Office Staff is Already Exists");
        }
        else{
            $user = Bank::where('email', $request->Email)->first();
            if ($user) {
                $user->assignRole('bank_office');
                return redirect()->route('bank.officeStaff')->with('success', 'Successfully Add Staff');
            } else {
                $new = new Bank();
                $new->fname = $request->First_Name;
                $new->lname = $request->Last_Name;
                $new->email = $request->Email;
                $new->phone = $request->Number;
                $new->password = Hash::make($request->password);
                $save = $new->save();
                $new->assignRole('bank_office');
                if ($save) {
                    return redirect()->route('bank.officeStaff')->with('success', 'Successfully Add Staff');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Add Staff");
                }
            }
        }
    }
    public function officeStaffEdit(Request $request)
    {
        $data=Bank::where('id',$request->id)->first();
        return view('editBankOfficeStaff', compact('data'));
    }

    public function bankOfficeStaffEditData(Request $request)
    {
        $request->validate([
            "First_Name" => "required",
            "Last_Name" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
        ]);
        $user=Bank::where('email', $request->Email)->update([
            "fname"=>$request->First_Name,
            "lname"=>$request->Last_Name,
            "phone"=>$request->Number,
        ]);
        if ($user) {
            return redirect()->route('bank.officeStaff')->with('success', 'Successfully Edit Staff');
        }
    }
    public function officeStaffDelete(Request $request)
    {
        $data=Bank::where('id',$request->id)->first();
        if ($data) {
            $data->removeRole('bank_office');
            Bank::where('id',$request->id)->delete();
            return response("successfully delete");
        }
    }
}
