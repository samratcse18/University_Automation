<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Chairman;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Hall;
use App\Models\HallTotalStudent;
use App\Models\Record;
use App\Models\Session;
use App\Models\ProfessionalSession;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Exam;
use App\Models\Admission;
use App\Models\HallCircular;
use App\Models\Admin;
use App\Models\HallRoom;
use App\Models\Faculty;
use App\Imports\admissionRollImport;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Excel;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function home()
    {
        return view('DashboardContent');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function profileUpdate()
    {
        return view('adminProfile');
    }

    public function updateProfileData(Request $request)
    {
        $request->validate([
            'FirstName'=>'required',
            'LastName'=>'required',
            'Phone'=>'required',
        ]);
        $user = Auth::guard('admin')->user();
        $data=Admin::where('email', $user->email)->update([
            "fname" => $request->FirstName,
            "lname" => $request->LastName,
            "phone" => $request->Phone,
        ]);
        if ($user->hasRole('superAdmin')) {
            if ($user->email==$request->Email) {
                $request->validate([
                'Email'=>'required',
                ]);
            }
            else {
                $request->validate([
                    'Email'=>'required|unique:admins,email',
                ]);
            }
            $data=Admin::where('email', $user->email)->update([
                "email" => $request->Email,
            ]);
        }
        if ($user->hasRole('admin')) {
            $request->validate([
                'name_bangla'=>'required',
            ]);
            $chairman=Chairman::where('email',$user->email)->first();
            $data=Chairman::where('email',$user->email)->update([
                'name_bangla'=>$request->name_bangla,
                'name_english'=>$user->fname.' '.$user->lname, 
            ]);
        }
        if ($request->password) {
            $request->validate([
            'password' => 'required|min:8|max:16',
            'cpassword' => 'required|same:password',
            ]);
            $update=Admin::where('id',$user->id)->update([
            'password'=>Hash::make($request->password),
            ]);
        }
        if ($request->img) {
            $request->validate([
                    'img'=>'required|mimes:jpg,png,jpeg|max:1024',
            ]);
            if ($user->img!=NULL) {
                $path=public_path('images/'.$user->img);
                unlink($path);
                // File::delete($path);
            }
            $upload_path = public_path('images');
            $file_name = $request->file('img')->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file('img')->getClientOriginalExtension();
            $submit = $request->file('img')->move($upload_path, $generated_new_name);
            $data=Admin::where('email', $user->email)->update([
                "img"=>$generated_new_name,
            ]);
        }
        if ($request->signature) {
            $request->validate([
                'signature'=>'mimes:jpg,png,jpeg|max:1024',
            ]);
            if (!empty($user->signature)) {
                $path=public_path('images/'.$user->signature);
                unlink($path);
            }
            $upload_path = public_path('images');
            $file_name = $request->file('signature')->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file('signature')->getClientOriginalExtension();
            $submit = $request->file('signature')->move($upload_path, $generated_new_name);
            $data=Admin::where('email',$user->email)->update([
                "signature" => $generated_new_name,
            ]);
            if ($user->hasRole('admin')) {
                Chairman::where('email',$user->email)->update([
                    "signature" => $generated_new_name,
                ]);
            }
        }
        return redirect()->route('user.admin')->with('success', 'Successfully Update Profile');
    }

    public function fee()
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $data = Fee::where("fee_for", $user->dept)->get();
            return view('fee', compact('data'));
        }
        elseif ($user->hasRole('provost')) {
            $hall=Hall::where('email',$user->email)->first();
            $data = Fee::where("fee_for", $hall->name)->get();
            return view('fee', compact('data'));
        }
        elseif ($user->hasRole('controller')) {
            $data = Fee::where("fee_for", 'controller')->get();
            return view('fee', compact('data'));
        }
        else {
            $data = Fee::where('fee_for', 'varsity')->get();
            return view('fee', compact('data'));
        }
    }

    //....................addFee....................
    public function addFee()
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            // $degree = DB::table('chairmen')
            //     ->where('email', $user->email)
            //     ->join('degrees', 'chairmen.department', '=', 'degrees.degree_for')
            //     ->where('degrees.degree_name','!=','null')
            //     ->select('degrees.degree_name')
            //     ->get();
            $session = Session::orderBy('session', 'desc')->get();
            $professionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
            $data = BankAccount::where("account_for", $user->dept)->get();
            return view('addFee', compact('data','session','professionalSession'));
        } 
        elseif ($user->hasRole('provost')) {
            $hall=Hall::where('email',$user->email)->first();
            $data = BankAccount::where("account_for", $hall->name)->get();
            $session = Session::orderBy('session', 'desc')->get();
            $professionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
            return view('addFee', compact('data','session','professionalSession'));
        }
        else {
            $data = BankAccount::where("account_for", 'varsity')->get();
            $session = Session::orderBy('session', 'desc')->get();
            $professionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
            return view('addFee', compact('data','session','professionalSession'));
        }

    }

    public function fee_submit(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Amount" => "required",
                "Type" => "required",
                "program_type" => "required",
                "Class" => "required",
            ]);
            if (empty($request->service)) {
                $request->validate([
                    "session" => "required",
                    "semester" => "required",
                ]);
            }
            $dept = Chairman::where('email', $user->email)->first();
            if ($request->service) {
                $save = new Fee();
                $save->fee_for = $dept->department;
                $save->fee_title = $request->Fee_Title;
                $save->account_number = $request->Account_Number;
                $save->amount = $request->Amount;
                $save->type = $request->Type;
                $save->program_type = $request->program_type;
                $save->class = $request->Class;
                $save->service = $request->service;
                $data = $save->save();
            }
            else {
                $save = new Fee();
                $save->fee_for = $dept->department;
                $save->fee_title = $request->Fee_Title;
                $save->account_number = $request->Account_Number;
                $save->amount = $request->Amount;
                $save->type = $request->Type;
                $save->program_type = $request->program_type;
                $save->session = $request->session;
                $save->class = $request->Class;
                $save->semester = json_encode($request->semester);
                $data = $save->save();
            }
            if ($data) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Add Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Fee");
            }
        } 
        else if ($user->hasRole('superAdmin')) {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Amount" => "required",
                "Type" => "required",
                "program_type" => "required",
                "Class" => "required",
            ],
            [
                "Type.required"=>"Please Select For Option",
            ]
            );
            // $dept = Chairman::where('email', $user->email)->first();
            $save = new Fee();
            $save->fee_for = "varsity";
            $save->fee_title = $request->Fee_Title;
            $save->account_number = $request->Account_Number;
            $save->amount = $request->Amount;
            $save->type = $request->Type;
            $save->program_type = $request->program_type;
            $save->session = $request->session;
            $save->class = $request->Class;
            $save->semester = json_encode($request->semester);
            $data = $save->save();
            if ($data) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Add Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Fee");
            }
        }
        else if ($user->hasRole('controller')) {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Amount" => "required",
                "program_type" => "required",
                "Class" => "required",
            ],
            [
                "Type.required"=>"Please Select For Option",
            ]
            );
            // $dept = Chairman::where('email', $user->email)->first();
            if ($request->Fee_Title=='Exam Hall Fee'||$request->Fee_Title=='Admit Card Fee') {
                $save = new Fee();
                $save->fee_for = "controller";
                $save->fee_title = $request->Fee_Title;
                $save->account_number = $request->Account_Number;
                $save->amount = $request->Amount;
                $save->type = 'Exam';
                $save->program_type = $request->program_type;
                $save->session = $request->session;
                $save->class = $request->Class;
                $data = $save->save();
            }
            else {
                $save = new Fee();
                $save->fee_for = "controller";
                $save->fee_title = $request->Fee_Title;
                $save->account_number = $request->Account_Number;
                $save->amount = $request->Amount;
                $save->type = 'Service';
                $save->program_type = $request->program_type;
                $save->session = $request->session;
                $save->class = $request->Class;
                $data = $save->save();
            }
            if ($data) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Add Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Fee");
            }
        }
        else if ($user->hasRole('provost')) {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Amount" => "required",
            ]);
            $user=Auth::guard('admin')->user();
            $hall=Hall::where('email',$user->email)->first();
            $save = new Fee();
            $save->fee_for = $hall->name;
            $save->fee_title = $request->Fee_Title;
            $save->account_number = $request->Account_Number;
            $save->amount = $request->Amount;
            $data = $save->save();
            if ($data) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Add Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Fee");
            }
        }

    }

    public function editFee(Request $request)
    {
        $data=Fee::find($request->id);
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $degree = DB::table('chairmen')
                ->where('email', $user->email)
                ->join('degrees', 'chairmen.department', '=', 'degrees.degree_for')
                ->where('degrees.degree_name','!=','null')
                ->select('degrees.degree_name')
                ->get();
            $account = BankAccount::where("account_for", $user->dept)->get();
            return view('editFee', compact('data', 'degree','account'));
        } 
        elseif ($user->hasRole('provost')) {
            $hall=Hall::where('email',$user->email)->first();
            $account = BankAccount::where("account_for", $hall->name)->get();
            return view('editFee', compact('data','account'));
        }
        else {
            $account = BankAccount::where("account_for", 'varsity')->get();
            return view('editFee', compact('data','account'));
        }
    }

    public function editFeeData(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Class" => "required",
                "Amount" => "required",
                "Type" => "required",
            ],
            [
                "Type.required"=>"Please Select For Option",
            ]
        );
            $dept = Chairman::where('email', $user->email)->first();
            $update = Fee::where('id',$request->id)->update([
            'fee_for' => $dept->department,
            'fee_title' => $request->Fee_Title,
            'account_number' => $request->Account_Number,
            'class' => $request->Class,
            'amount' => $request->Amount,
            'type' => $request->Type,
            ]);
            if ($update) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Update Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Update Fee");
            }
        } else {
            $request->validate([
                "Fee_Title" => "required",
                "Account_Number" => "required",
                "Amount" => "required",
            ]);
            $update = Fee::where('id',$request->id)->update([
            'fee_for' => 'varsity',
            'fee_title' => $request->Fee_Title,
            'account_number' => $request->Account_Number,
            'amount' => $request->Amount,
            ]);
            if ($update) {
                return redirect()->route('admin.fee')->with('success', 'Successfully Update Fee');
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Update Fee");
            }
        }
    }

    public function deleteFee(Request $request)
    {
        Fee::find($request->id)->delete();
        return "success";
    }

    public function faculty()
    {
        $data = Faculty::all();
        // // echo $role;
        // echo $data;
        return view('facultyHome', compact('data'));
    }

    //...............create_faculty..............
    public function createFaculty(Request $request)
    {
        $request->validate([
            "Faculty_Name" => "required|unique:faculties,name",
        ]);
        $Faculty = new Faculty();
        $Faculty->name = $request->Faculty_Name;
        $data = $Faculty->save();
        if ($data) {
            return redirect()->route('admin.faculty')->with('success', 'Successfully Add Faculty');
        } else {
            return redirect()->back()->with('error', "Unsuccessfully Add Faculty");
        }
    }

    //..................editFaculty................
    public function editFaculty(Request $request)
    {
        $id = $request->id;
        $Faculty = Faculty::where('id', $id)->first();
        return view('editFaculty', compact('Faculty'));

    }

    public function editFacultyData(Request $request)
    {
        $request->validate([
                'id' => 'required',
                'name' => 'required',
            ]);
        $id = $request->id;
        $update = Faculty::where('id', $id)->update(['name' => $request->name]);
        if ($update) {
            return redirect()->route('admin.faculty')->with('success', 'Successfully Update Faculty Name');
        } else {
            return redirect()->back()->with('err', "Unsuccessfully Update Faculty Name");
        }
    }

    public function facultyDelete(Request $request)
    {
        $id = $request->id;
        $Faculty = Faculty::where('id', $id)->first();
        if (!empty($Faculty->email)) {
            $dean = Admin::where('email', $Faculty->email)->first();
            $dean->removeRole('dean');
        }
        $Faculty = Faculty::where('id', $id)->delete();
        return "Successfully Delete";
    }

    //......................deanHome.....................
    public function deanHome()
    {
        $data = DB::table('faculties')
            ->join('admins', 'faculties.email', '=', 'admins.email')
            ->select('faculties.*', 'admins.fname', 'admins.lname')
            ->get();
        return view('deanHome', compact('data'));
    }

    //.................addDean.............
    public function addDean()
    {
        $faculty = Faculty::all();
        $dept = Department::orderBy('department', 'asc')->get();
        return view('addDean', compact('faculty', 'dept'));
    }

    //.....................deanCreate....................
    public function deanCreate(Request $request)
    {
        $request->validate([
            "Faculty_Name" => "required",
            "First_Name" => "required",
            "Last_Name" => "required",
            "Department" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
            "password" => "required|min:8|max:16",
            "cpassword" => "required|same:password",
        ]);

        $Update = Faculty::where('name', $request->Faculty_Name)->update(['email' => $request->Email, 'dept' => $request->Department]);
        if ($Update) {
            $user = Admin::where('email', $request->Email)->first();
            if ($user) {
                $user->assignRole('dean');
                return redirect()->route('admin.dean')->with('success', 'Successfully Add Dean');
            } else {
                $new = new Admin();
                $new->fname = $request->First_Name;
                $new->lname = $request->Last_Name;
                $new->email = $request->Email;
                $new->dept = $request->Department;
                $new->phone = $request->Number;
                $new->password = Hash::make($request->password);
                $save = $new->save();
                $new->assignRole('dean', 'teacher');
                if ($save) {
                    return redirect()->route('admin.dean')->with('success', 'Successfully Add Dean');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Add Dean");
                }
            }
        }
    }

    //..................editDean....................
    public function editDean(Request $request)
    {
        $data = DB::table('faculties')
            ->where('faculties.id', '=', $request->id)
            ->join('admins', 'faculties.email', '=', 'admins.email')
            ->select('faculties.name', 'admins.*')
            ->first();
        $dept = Department::all();
        return view('editDean', compact('data', 'dept'));
    }

    //.................deanEditData...............
    public function deanEditData(Request $request)
    {
        $request->validate(
            [
                "Faculty_Name" => "required",
                "First_Name" => "required",
                "Last_Name" => "required",
                "Department" => "required",
                "Number" => "required",
                "Email" => "required",
            ],
            [
                "Department.required" => 'Please Select Department',
            ]
        );
        $Faculty = Faculty::where('name', $request->Faculty_Name)->first();
        if ($Faculty->email == $request->Email) {
            if ($request->password) {
                $password = Hash::make($request->password);
                $admin = Admin::where('email', $request->Email)->update(['fname' => $request->First_Name, 'lname' => $request->Last_Name, 'phone' => $request->Number, 'password' => $password]);
                if ($admin) {
                    return redirect()->route('admin.dean')->with('success', 'Successfully Update Dean Info');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Update Dean Info");
                }
            } else {
                $admin = Admin::where('email', $request->Email)->update(['fname' => $request->First_Name, 'lname' => $request->Last_Name, 'phone' => $request->Number]);
                if ($admin) {
                    return redirect()->route('admin.dean')->with('success', 'Successfully Update Dean Info');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Update Dean Info");
                }
            }

        } else {
            $dean = Admin::where('email', $Faculty->email)->first();
            if ($dean) {
                $dean->removeRole('dean');
                $update = Faculty::where('name', $request->Faculty_Name)->update(['email' => $request->Email, 'dept' => $request->Department]);
                $admin = Admin::where('email', $request->Email)->first();
                if ($admin) {
                    $admin->assignRole('dean');
                    return redirect()->route('admin.dean')->with('success', 'Successfully Add Dean');
                } else {
                    $new = new Admin();
                    $new->fname = $request->First_Name;
                    $new->lname = $request->Last_Name;
                    $new->email = $request->Email;
                    $new->dept = $request->Department;
                    $new->phone = $request->Number;
                    if ($request->password) {
                        $new->password = Hash::make($request->password);
                    } else {
                        $new->password = Hash::make(12345678);
                    }
                    $save = $new->save();
                    $new->assignRole('dean', 'teacher');
                    if ($save) {
                        return redirect()->route('admin.dean')->with('success', 'Successfully Add Dean');
                    } else {
                        return redirect()->back()->with('error', "Unsuccessfully Add Dean");
                    }
                }
            }

        }
    }

    public function deanDelete(Request $request)
    {
        $data=Faculty::find($request->id);
        $user=Admin::where('email',$data->email)->first();
        $user->removeRole('dean');
        $dean=Faculty::where('id',$request->id)->update([
            "email"=>NULL,
            "dept"=>NULL,
        ]);
        if ($dean) {
            return "successfully";
        }

    }

    public function hall()
    {
        $data = Hall::all();
        return view('hallHome', compact('data'));
    }
    public function createHall(Request $request)
    {
        $request->validate([
            "Hall_Name" => "required|unique:halls,name",
            "bangla_name" => "required|unique:halls,bangla_name",
        ]);

        $Hall = new Hall();
        $Hall->name = $request->Hall_Name;
        $Hall->bangla_name = $request->bangla_name;
        $data = $Hall->save();
        if ($data) {
            return redirect()->route('admin.hall')->with('success', 'Successfully Add Hall');
        }
        else {
            return redirect()->back()->with('error', "Unsuccessfully Add Hall");
        } 
    }
    public function editHall(Request $request)
    {
        $id = $request->id;
        $Hall = Hall::find($id);
        return view('editHall', compact('Hall'));
    }
    public function editHallData(Request $request)
    {
        $request->validate(
            [
                "Hall_Name" => "required",
            ],
            [
                "Department.required" => 'Please Select Department',
            ]
        );
        $id = $request->id;
        $update = Hall::where('id', $id)->update(['name' => $request->Hall_Name]);
        if ($update) {
            return redirect()->route('admin.hall')->with('success', 'Successfully Update Hall');
        } else {
            return redirect()->back()->with('err', "Unsuccessfully Update Hall");
        }
    }
    public function deleteHall(Request $request)
    {
        $id = $request->id;
        $Hall = Hall::where('id', $id)->first();
        if (!empty($Hall->email)) {
            $provost = Admin::where('email', $Hall->email)->first();
            $provost->removeRole('provost');
        }
        $Hall = Hall::where('id', $id)->delete();
        return "Successfully Delete";
    }

    public function provost()
    {
        $data = DB::table('halls')
            ->join('admins', 'halls.email', '=', 'admins.email')
            ->select('halls.*', 'admins.fname', 'admins.lname')
            ->get();
        return view('provostHome', compact('data'));
    }

    public function addProvost()
    {
        $hall = Hall::all();
        $dept = Department::orderBy('department', 'asc')->get();
        return view('addProvost', compact('hall', 'dept'));
    }

    public function provostCreate(Request $request)
    {
        $request->validate([
            "Hall_Name" => "required",
            "First_Name" => "required",
            "Last_Name" => "required",
            "Department" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
            "password" => "required|min:8|max:16",
            "cpassword" => "required|same:password",
        ]);

        $Update = Hall::where('name', $request->Hall_Name)->update(['email' => $request->Email, 'dept' => $request->Department]);
        if ($Update) {
            $user = Admin::where('email', $request->Email)->first();
            if ($user) {
                $user->assignRole('provost');
                return redirect()->route('admin.provost')->with('success', 'Successfully Add Provost');
            } else {
                $new = new Admin();
                $new->fname = $request->First_Name;
                $new->lname = $request->Last_Name;
                $new->email = $request->Email;
                $new->dept = $request->Department;
                $new->phone = $request->Number;
                $new->password = Hash::make($request->password);
                $save = $new->save();
                $new->assignRole('provost', 'teacher');
                if ($save) {
                    return redirect()->route('admin.provost')->with('success', 'Successfully Add Provost');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Add Provost");
                }
            }
        }
    }

    public function editProvost(Request $request)
    {
        $data = DB::table('halls')
            ->where('halls.id', '=', $request->id)
            ->join('admins', 'halls.email', '=', 'admins.email')
            ->select('halls.name', 'admins.*')
            ->first();
        $dept = Department::all();
        return view('editProvost', compact('data', 'dept'));
    }

    public function editProvostData(Request $request)
    {
        $request->validate(
            [
                "Hall_Name" => "required",
                "First_Name" => "required",
                "Last_Name" => "required",
                "Department" => "required",
                "Number" => "required",
                "Email" => "required",
            ],
            [
                "Department.required" => 'Please Select Department',
            ]
        );
        $Hall = Hall::where('name', $request->Hall_Name)->first();
        if ($Hall->email == $request->Email) {
            if ($request->password) {
                $password = Hash::make($request->password);
                $admin = Admin::where('email', $request->Email)->update([
                    'fname' => $request->First_Name, 
                    'lname' => $request->Last_Name, 
                    'dept' => $request->Department, 
                    'phone' => $request->Number, 
                    'password' => $password]
                );
                if ($admin) {
                    return redirect()->route('admin.provost')->with('success', 'Successfully Update Provost Info');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Update Provost Info");
                }
            } else {
                $admin = Admin::where('email', $request->Email)->update([
                    'fname' => $request->First_Name,
                    'lname' => $request->Last_Name, 
                    'dept' => $request->Department, 
                    'phone' => $request->Number
                ]);
                if ($admin) {
                    return redirect()->route('admin.provost')->with('success', 'Successfully Update Provost Info');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Update Provost Info");
                }
            }

        } else {
            $provost = Admin::where('email', $Hall->email)->first();
            if ($provost) {
                $provost->removeRole('provost');
                $update = Hall::where('name', $request->Hall_Name)->update(['email' => $request->Email, 'dept' => $request->Department]);
                $admin = Admin::where('email', $request->Email)->first();
                if ($admin) {
                    $admin->assignRole('provost');
                    return redirect()->route('admin.provost')->with('success', 'Successfully Add Provost');
                } else {
                    $new = new Admin();
                    $new->fname = $request->First_Name;
                    $new->lname = $request->Last_Name;
                    $new->email = $request->Email;
                    $new->dept = $request->Department;
                    $new->phone = $request->Number;
                    if ($request->password) {
                        $new->password = Hash::make($request->password);
                    } else {
                        $new->password = Hash::make(12345678);
                    }
                    $save = $new->save();
                    $new->assignRole('provost', 'teacher');
                    if ($save) {
                        return redirect()->route('admin.provost')->with('success', 'Successfully Add Provost');
                    } else {
                        return redirect()->back()->with('err', "Unsuccessfully Add Provost");
                    }
                }
            }

        }
    }

    public function provostDelete(Request $request)
    {
        $data=Hall::find($request->id);
        $user=Admin::where('email',$data->email)->first();
        $user->removeRole('provost');
        $provost=Hall::where('id',$request->id)->update([
            "email"=>NULL,
            "dept"=>NULL,
        ]);
        if ($provost) {
            return "successfully";
        }
    }

    public function session()
    {
        $session = Session::orderBy('session', 'desc')->get();
        return view('sessionHome', compact('session'));
    }

    public function addSession(Request $request)
    {
        $year = $request->year1 . '-' . $request->year2;
        $exist = Session::where('session', $year)->first();
        if ($exist) {
            return redirect()->route('admin.session')->with('err', "This Session Already Exist");
        } else {
            $session = new Session();
            $session->session = $year;
            $save = $session->save();
            if ($save) {
                return redirect()->route('admin.session')->with('success', "Successfully Add Session");
            } else {
                return redirect()->route('admin.session')->with('err', "Unsuccessfully Add Session");
            }
        }
    }


    //..................Department_Option_Show.....................
    public function department()
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('superAdmin')) {
            $data = Department::orderBy('department', 'asc')->get();
            return view('departmentHome', compact('data'));
        }
        else {
            $data = DB::table('faculties')
                ->where('email', '=', $user->email)
                ->join('departments', 'faculties.name', '=', 'departments.faculty')
                ->select('departments.*')
                ->get();
            return view('departmentHome', compact('data'));
        }
    }
    //................Add_Department_View........................
    public function addDepartmentView()
    {
        $user=Auth::guard('admin')->user();
        if ($user->hasRole('superAdmin')) {
            $faculty=Faculty::all();
            return view('addDepartment',compact('faculty'));
        }
        else {
            return view('addDepartment');
        }
    }

    //..............Department_create................
    public function departmentCreate(Request $request)
    {
        $user=Auth::guard('admin')->user();
        if ($user->hasRole('superAdmin')) {
            $request->validate([
            'Department_Name'=>'required|unique:departments,department',
            'Department_FullName'=>'required|unique:departments,department_full',
            'Department_BN'=>'required|unique:departments,department_bn',
            'Faculty_Name'=>'required',
            ]);
            $new = new Department();
            $new->department = $request->Department_Name;
            $new->department_full = $request->Department_FullName;
            $new->department_bn = $request->Department_BN;
            $new->faculty = $request->Faculty_Name;
            $save = $new->save();
            if ($save) {
                return redirect()->route('user.admin')->with('success', "Successfully Add Department");
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Department");
            }
        }
        else {
            $request->validate([
                'Department_Name'=>'required|unique:departments,department',
                'Department_FullName'=>'required|unique:departments,department_full',
                'Department_BN'=>'required|unique:departments,department_bn',
            ]);
            $faculty = Auth::guard('admin')->user()->email;
            $result = Faculty::where('email', $faculty)->first();
            $new = new Department();
            $new->department = $request->Department_Name;
            $new->department_full = $request->Department_FullName;
            $new->department_bn = $request->Department_BN;
            $new->faculty = $result->name;
            $save = $new->save();
            if ($save) {
                return redirect()->route('admin.department')->with('success', "Successfully Add Department");
            } else {
                return redirect()->back()->with('err', "Unsuccessfully Add Department");
            }
        }
    }

    //..............Department_Edit_view.................
    public function editDepartmentView(Request $request)
    {
        $department = Department::where('id', $request->id)->first();
        return view('editDepartment', compact('department'));
    }

    //..................departmentEditData................
    public function departmentEditData(Request $request)
    {
        $request->validate([
            'Department_Name' => 'required',
            'Department_FullName' => 'required',
            'Department_BN' => 'required',
        ]);
        $user=Auth::guard('admin')->user();
        $record=new Record();
        $record->department=$user->id;
        $record->chairman='NULL';
        $record->dean='NULL';
        $record->provost='NULL';
        $record->hall='NULL';
        $record->session='NULL';
        $record->save();
        $data = Department::where('id', $request->id)->update([
            'department' => $request->Department_Name,
            'department_full' => $request->Department_FullName,
            'department_bn' => $request->Department_BN,
        ]);
        if ($data) {
            return redirect()->route('admin.department')->with('success', "Successfully Update Department");
        } else {
            return redirect()->back()->with('err', "Unsuccessfully Update Department");
        }
    }

    //...............deleteDepartment.................
    public function deleteDepartment(Request $request)
    {
        $user=Auth::guard('admin')->user();
        $record=new Record();
        $record->department=$user->id;
        $record->chairman='NULL';
        $record->dean='NULL';
        $record->provost='NULL';
        $record->hall='NULL';
        $record->session='NULL';
        $record->save();
        $delete = Department::where('id', $request->id)->delete();
        if ($delete) {
            return redirect()->route('admin.department')->with('success', "Successfully Delete Department");
        } else {
            return redirect()->back()->with('err', "Unsuccessfully Delete Department");
        }
    }

    //..............Chairman_show..................
    public function chairmanHome()
    {
        $user = Auth::guard('admin')->user()->email;
        $faculty = Faculty::where('email', $user)->first();
        $data = DB::table('chairmen')
            ->where('faculty', '=', $faculty->name)
            ->join('admins', 'chairmen.email', '=', 'admins.email')
            ->select('admins.fname', 'admins.lname', 'chairmen.*')
            ->get();
        return view('chairmanHome', compact('data'));
    }

    //..................add_chairman.................
    public function ChairmanAdd()
    {
        $user = Auth::guard('admin')->user()->email;
        $data = DB::table('faculties')
            ->where('email', '=', $user)
            ->join('departments', 'faculties.name', '=', 'departments.faculty')
            ->select('departments.*')
            ->get();
        return view('addChairman', compact('data'));
    }

    //............addChairmanData................
    public function chairmanCreate(Request $request)
    {
        $request->validate([
            "Department" => "required|unique:chairmen,department",
            "First_Name" => "required",
            "Last_Name" => "required",
            "Department_self" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
            "password" => "required|min:8|max:16",
            "cpassword" => "required|same:password",
        ]);
        $user = Auth::guard('admin')->user()->email;
        $faculty = Faculty::where('email', $user)->first();

        $Chairman = new Chairman();
        $Chairman->department = $request->Department;
        $Chairman->faculty = $faculty->name;
        $Chairman->email = $request->Email;
        $data = $Chairman->save();
        if ($data) {
            $user = Admin::where('email', $request->Email)->first();
            if ($user) {
                $user->assignRole('admin');
                return redirect()->route('admin.chairman')->with('success', 'Successfully Add Chairman');
            } else {
                $new = new Admin();
                $new->fname = $request->First_Name;
                $new->lname = $request->Last_Name;
                $new->email = $request->Email;
                $new->dept = $request->Department_self;
                $new->phone = $request->Number;
                $new->password = Hash::make($request->password);
                $save = $new->save();
                $new->assignRole('admin', 'teacher');
                if ($save) {
                    return redirect()->route('admin.chairman')->with('success', 'Successfully Add Chairman');
                } else {
                    return redirect()->back()->with('err', "Unsuccessfully Add Chairman");
                }
            }
        }
    }

    //....................Edit_chairman.....................
    public function editChairman(Request $request)
    {
        $user = Auth::guard('admin')->user()->email;
        $data = DB::table('chairmen')
            ->where('chairmen.id', '=', $request->id)
            ->join('admins', 'chairmen.email', '=', 'admins.email')
            ->select('chairmen.*', 'admins.fname', 'admins.lname', 'admins.dept', 'admins.phone')
            ->first();
        $department = DB::table('faculties')
            ->where('email', '=', $user)
            ->join('departments', 'faculties.name', '=', 'departments.faculty')
            ->select('departments.*')
            ->get();
        // echo '<pre>';
        // print_r($data);
        return view('editChairman', compact('data', 'department'));
    }

    //..................editChairmanData...............
    public function editChairmanData(Request $request)
    {
        $request->validate(
            [
                "Department" => "required",
                "First_Name" => "required",
                "Last_Name" => "required",
                "Department_self" => "required",
                "Number" => "required",
                "Email" => "required",
            ],
            [
                "Department.required" => 'Please Select Department',
            ]
        );
        $user = Auth::guard('admin')->user();
        $record=new Record();
        $record->chairman=$user->id;
        $record->department='NULL';
        $record->dean='NULL';
        $record->provost='NULL';
        $record->hall='NULL';
        $record->session='NULL';
        $record->save();
        $faculty = Faculty::where('email', $user->email)->first();
        $id = $request->id;
        $chairman = Chairman::where('id', $id)->first();
        if ($chairman->email == $request->Email) {
            $update = Chairman::where('id', $id)->update(['department' => $request->Department]);
            if ($request->password) {
                $password = Hash::make($request->password);
                $admin = Admin::where('email', $request->Email)->update(['fname' => $request->First_Name, 'lname' => $request->Last_Name, 'phone' => $request->Number, 'password' => $password]);
                if ($admin) {
                    return redirect()->route('admin.chairman')->with('success', 'Successfully Update Chairman Info');
                } else {
                    return redirect()->back()->with('error', "Unsuccessfully Update Chairman Info");
                }
            } else {
                $admin = Admin::where('email', $request->Email)->update(['fname' => $request->First_Name, 'lname' => $request->Last_Name, 'phone' => $request->Number]);
                if ($admin) {
                    return redirect()->route('admin.chairman')->with('success', 'Successfully Update Chairman Info');
                } else {
                    return redirect()->back()->with('error', "Unsuccessfully Update Chairman Info");
                }
            }

        } else {
            $exist = Admin::where('email', $chairman->email)->first();
            if ($exist) {
                $exist->removeRole('admin');
                $update = Chairman::where('id', $id)->update(['department' => $request->Department, 'faculty' => $faculty->name, 'email' => $request->Email]);
                $admin = Admin::where('email', $request->Email)->first();
                if ($admin) {
                    $admin->assignRole('admin');
                    return redirect()->route('admin.chairman')->with('success', 'Successfully Add Chairman');
                } else {
                    $new = new Admin();
                    $new->fname = $request->First_Name;
                    $new->lname = $request->Last_Name;
                    $new->email = $request->Email;
                    $new->dept = $request->Department_self;
                    $new->phone = $request->Number;
                    if ($request->password) {
                        $new->password = Hash::make($request->password);
                    } else {
                        $new->password = Hash::make(12345678);
                    }
                    $save = $new->save();
                    $new->assignRole('admin', 'teacher');
                    if ($save) {
                        return redirect()->route('admin.chairman')->with('success', 'Successfully Add Chairman');
                    } else {
                        return redirect()->back()->with('error', "Unsuccessfully Add Chairman");
                    }
                }
            }

        }
    }

    public function deleteChairman(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $record=new Record();
        $record->chairman=$user->id;
        $record->department='NULL';
        $record->dean='NULL';
        $record->provost='NULL';
        $record->hall='NULL';
        $record->session='NULL';
        $record->save();
        $chairman = Chairman::where('id', $request->id)->first();
        $exist = Admin::where('email', $chairman->email)->first();
        $exist->removeRole('admin');
        Chairman::where('id', $request->id)->delete();
        return "success";
    }

    //..................account........................
    public function account()
    {
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $chairman = Chairman::where('email', $user->email)->first();
            $data = BankAccount::where('account_for', $chairman->department)->get();
            return view('accountHome', compact('data'));
        }
        elseif ($user->hasRole('provost')) {
            $hall = Hall::where('email', $user->email)->first();
            $data = BankAccount::where('account_for', $hall->name)->get();
            return view('accountHome', compact('data'));
        }
        elseif ($user->hasRole('controller')) {
            $data = BankAccount::whereIn('account_for', ['controller','varsity'])->get();
            return view('accountHome', compact('data'));
        }
        else {
            $data = BankAccount::where('account_for', 'varsity')->get();
            return view('accountHome', compact('data'));
        }
    }

    //............................addAccount.................
    public function addAccount()
    {
        return view('addAccount');
    }

    //..........................createAccount....................
    public function createAccount(Request $request)
    {
        $request->validate([
            "Account_Number" => "required|unique:bank_accounts,account",
            "Account_Name" => "required",
            "Account_Type" => "required",
            "Branch" => "required",
        ]);
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $data = Chairman::where('email', $user->email)->first();
            $account = new BankAccount();
            $account->account = $request->Account_Number;
            $account->name = $request->Account_Name;
            $account->type = $request->Account_Type;
            $account->branch = $request->Branch;
            $account->account_for = $data->department;
            $account->save();
            return redirect()->route('admin.account')->with('success', 'Successfully Add Account');
        }
        elseif ($user->hasRole('provost')) {
            $data = Hall::where('email', $user->email)->first();
            $account = new BankAccount();
            $account->account = $request->Account_Number;
            $account->name = $request->Account_Name;
            $account->type = $request->Account_Type;
            $account->branch = $request->Branch;
            $account->account_for = $data->name;
            $account->save();
            return redirect()->route('admin.account')->with('success', 'Successfully Add Account');
        }
        elseif ($user->hasRole('controller')) {
            $account = new BankAccount();
            $account->account = $request->Account_Number;
            $account->name = $request->Account_Name;
            $account->type = $request->Account_Type;
            $account->branch = $request->Branch;
            $account->account_for = 'controller';
            $account->save();
            return redirect()->route('admin.account')->with('success', 'Successfully Add Account');
        }
        else {
            $account = new BankAccount();
            $account->account = $request->Account_Number;
            $account->name = $request->Account_Name;
            $account->type = $request->Account_Type;
            $account->branch = $request->Branch;
            $account->account_for = 'varsity';
            $account->save();
            return redirect()->route('admin.account')->with('success', 'Successfully Add Account');
        }
    }

    public function editAccount(Request $request)
    {
        $id=$request->id;
        $data=BankAccount::find($id);
        return view('editBankAccount', compact('data'));
    }

    public function editAccountData(Request $request)
    {
        $request->validate([
            "Account_Number" => "required",
            "Account_Name" => "required",
            "Account_Type" => "required",
            "Branch" => "required",
        ]);
        $id=$request->id;
        $user = Auth::guard('admin')->user();
        if ($user->hasRole('admin')) {
            $data = Chairman::where('email', $user->email)->first();
            $update=BankAccount::where('id',$id)->update([
            "name"=>$request->Account_Name,
            "account"=>$request->Account_Number,
            "type"=>$request->Account_Type,
            "branch"=>$request->Branch,
            "account_for"=>$data->department,
            ]);
            if ($update) {
                return redirect()->route('admin.account')->with('success', 'Successfully Update Account');
            }
        }
        elseif ($user->hasRole('provost')) {
            $data = Hall::where('email', $user->email)->first();
            $update=BankAccount::where('id',$id)->update([
            "name"=>$request->Account_Name,
            "account"=>$request->Account_Number,
            "type"=>$request->Account_Type,
            "branch"=>$request->Branch,
            "account_for"=>$data->name,
            ]);
            if ($update) {
                return redirect()->route('admin.account')->with('success', 'Successfully Update Account');
            }
        }
        else {
            $update=BankAccount::where('id',$id)->update([
            "name"=>$request->Account_Name,
            "account"=>$request->Account_Number,
            "type"=>$request->Account_Type,
            "branch"=>$request->Branch,
            "account_for"=>'varsity',
            ]);
            if ($update) {
                return redirect()->route('admin.account')->with('success', 'Successfully Update Account');
            }
        }
        
    }

    public function deleteAccount(Request $request)
    {
        $id=$request->id;
        $data=BankAccount::find($id)->delete();
        return 'success';
    }

    //................degreeHome............
    public function degree()
    {
        $user=Auth::guard('admin')->user();
        $faculty=Faculty::where('email',$user->email)->first();
        $data = Degree::where('degree_name', '!=', 'null')->where('faculty', $faculty->name)->get();
        return view('degreeHome', compact('data'));
    }

    public function addDegree()
    {
        return view('addDegree');
    }


    //......................createDegree................
    public function createDegree(Request $request)
    {
        $request->validate([
            "Degree_Name" => "required",
            "Degree_Full_Name" => "required",
            "Degree_Level" => "required",
        ]);
        $user=Auth::guard('admin')->user();
        $faculty=Faculty::where('email',$user->email)->first();
        $degree = new Degree();
        $degree->degree_name = $request->Degree_Name;
        $degree->degree_full_name = $request->Degree_Full_Name;
        $degree->class_level = $request->Degree_Level;
        $degree->special_degree = 'null';
        $degree->faculty = $faculty->name;
        $data = $degree->save();
        if ($data) {
            return redirect()->route('admin.degree')->with('success', 'Successfully Add Degree');
        } else {
            return redirect()->back()->with('err', 'Unsuccessfully Add Degree');
        }
    }

    public function editDegree(Request $request)
    {
        $data=Degree::find($request->id);
        return view('editDegree', compact('data'));
    }

    public function editDegreeData(Request $request)
    {
        $request->validate([
            "Degree_Name" => "required",
            "Degree_Full_Name" => "required",
            "Degree_Level" => "required",
        ]);
        $update=Degree::where('id',$request->id)->update([
            'degree_name'=>$request->Degree_Name,
            'degree_full_name'=>$request->Degree_Full_Name,
            'class_level'=>$request->Degree_Level,
        ]);
        if ($update) {
            return redirect()->route('admin.degree')->with('success', 'Successfully Update Degree');
        }
        else {
            return redirect()->back()->with('err', 'Unsuccessfully Update Degree');
        }

    }

    public function deleteDegree(Request $request)
    {
        Degree::find($request->id)->delete();
        return "success";
    }

    //............................specialDegree...................
    public function specialDegree()
    {
        $user=Auth::guard('admin')->user();
        $faculty=Faculty::where('email',$user->email)->first();
        $data = Degree::where('special_degree', '!=', 'null')->where('faculty', $faculty->name)->get();
        return view('specialDegree', compact('data'));
    }

    //........................addSpecialDegree.......................
    public function addSpecialDegree()
    {
        return view('addSpecialDegree');
    }

    //......................createSpecialDegree......................
    public function createSpecialDegree(Request $request)
    {
        $request->validate([
            "Special_Degree_Name" => "required",
            "Degree_Full_Name" => "required",
            "Degree_Level" => "required",
        ]);
        $user=Auth::guard('admin')->user();
        $faculty=Faculty::where('email',$user->email)->first();
        $degree = new Degree();
        $degree->special_degree = $request->Special_Degree_Name;
        $degree->degree_full_name = $request->Degree_Full_Name;
        $degree->class_level = $request->Degree_Level;
        $degree->degree_name = 'null';
        $degree->faculty = $faculty->name;
        $data = $degree->save();
        if ($data) {
            return redirect()->route('admin.specialDegree')->with('success', 'Successfully Add Degree');
        } else {
            return redirect()->back()->with('err', 'Unsuccessfully Add Degree');
        }
    }

    public function editSpecialDegree(Request $request)
    {
        $data=Degree::find($request->id);
        return view('editSpecialDegree', compact('data'));
    }

    public function editSpecialDegreeData(Request $request)
    {
        $request->validate([
            "Special_Degree_Name" => "required",
            "Degree_Full_Name" => "required",
            "Degree_Level" => "required",
        ]);
        $update=Degree::where('id',$request->id)->update([
            'special_degree'=>$request->Special_Degree_Name,
            'degree_full_name'=>$request->Degree_Full_Name,
            'class_level'=>$request->Degree_Level,
        ]);
        if ($update) {
            return redirect()->route('admin.specialDegree')->with('success', 'Successfully Update Degree');
        }
        else {
            return redirect()->back()->with('err', 'Unsuccessfully Update Degree');
        }
    }

    public function deleteSpecialDegree(Request $request)
    {
        Degree::find($request->id)->delete();
        return "success";
    }

    //..........................officeStaff...................
    public function officeStaff()
    {
        $user=Auth::guard('admin')->user()->email;
        $dept=Chairman::where('email',$user)->first()->department;
        $data=Admin::where('dept',$dept)->role('office')->get();
        return view('officeStaffHome', compact('data'));
    }

    //......................addOfficeStaff...................
    public function addOfficeStaff()
    {
        $user = Auth::guard('admin')->user()->email;
        $dept = Chairman::where('email', $user)->first()->department;
        return view('addOfficeStaff', compact('dept'));
    }

    //...............................officeStaffCreate....................
    public function officeStaffCreate(Request $request)
    {
        $request->validate([
            "First_Name" => "required",
            "Last_Name" => "required",
            "Department" => "required",
            "Number" => "required|regex:/(01)[0-9]{9}/",
            "Email" => "required",
            "password" => "required|min:8|max:16",
            "cpassword" => "required|same:password",
        ]);
        $user=Admin::where('email', $request->Email)->role('office')->first();
        if ($user) {
            return redirect()->back()->with('error', "This Office Staff is Already Exists");
        }
        else{
            $user = Admin::where('email', $request->Email)->first();
            if ($user) {
                $user->assignRole('office');
                return redirect()->route('admin.officeStaff')->with('success', 'Successfully Add Staff');
            } else {
                $new = new Admin();
                $new->fname = $request->First_Name;
                $new->lname = $request->Last_Name;
                $new->email = $request->Email;
                $new->dept = $request->Department;
                $new->phone = $request->Number;
                $new->password = Hash::make($request->password);
                $save = $new->save();
                $new->assignRole('office');
                if ($save) {
                    return redirect()->route('admin.officeStaff')->with('success', 'Successfully Add Staff');
                } else {
                    return redirect()->back()->with('error', "Unsuccessfully Add Staff");
                }
            }
        }
    }

    public function deleteOfficeStaff(Request $request)
    {
        $exist=Admin::find($request->id);
        $exist->removeRole('office');
        Admin::where('id', $request->id)->delete();
        return "success";
    }

    public function professionalSession()
    {
        $professionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
        $session = Session::orderBy('session', 'desc')->get();
        return view('professionalSessionHome', compact('professionalSession','session'));
    }

    public function addProfessionalSession(Request $request)
    {
        $request->validate([
            "Session"=>"required",
            "Term"=>"required",
        ]);
        $session=$request->Session.'-'.'('.$request->Term.')';
        $exist=ProfessionalSession::where('professional_session',$session)->first();
        if ($exist) {
            return redirect()->back()->with('err', "This Session is Already Exists");
        }
        else{
            $add=new ProfessionalSession();
            $add->professional_session=$session;
            $data=$add->save();
            if ($data) {
                return redirect()->back()->with('success', "Successfully Add Session");
            }
        }
    }

    public function hallStudentStatus()
    {
        $user=Auth::guard('admin')->user();
        $hall=Hall::where('email',$user->email)->first();
        $data=HallTotalStudent::where('hall_name',$hall->name)->where('status','pending')->with('student')->get();
        // echo ($data);
        return view('hallStudentStatus',compact('data'));
    }

    public function hallStatusView(Request $request)
    {
        $data = Student::find($request->id);
        $room=HallRoom::all();
        return view('hallStatusView', compact('data','room'));
    }

    public function searchHallStudent(Request $request)
    {
        $user=Auth::guard('admin')->user()->email;
        $hall=Hall::where('email',$user)->first();
        $products=DB::table('hall_total_students')
            ->where([['hall_name',$hall->name],['status','pending']])
            ->join('students', 'hall_total_students.student_id', '=', 'students.id')
            ->where('students.student_id','LIKE','%'.$request->data."%")
            ->select('students.*')
            ->get();
        return Response($products);

    }

    public function studentAddToHall(Request $request)
    {
        $request->validate([
            'Room'=>"required",
        ]);
        $user = Student::find($request->id);
        $student=HallTotalStudent::where('student_id',$request->id)->update
        ([
        'status'=>'active',
        'room'=>$request->Room,
        'token'=>'300'.time(),
        ]);
        if ($student) {
            $data = [
                "email" => $user->email,
            ];
            Mail::send('HallMail', [], function ($message) use($data) {
                // $message->from('sender@example.com', 'Reset Password');
                $message->to($data['email']);
                $message->subject('Confirm');
            });
            return redirect()->route('admin.hallStudentStatus')->with('success','Successfully');
        }
    }


    public function hallRoom()
    {
        $data=HallRoom::all();
        return view('hallRoom',compact('data'));
    }

    public function addHallRoom(Request $request)
    {
        $request->validate([
            "Room"=>"required",
        ]);
        $user=Auth::guard('admin')->user()->email;
        $hall=Hall::where('email',$user)->first();
        $room=new HallRoom();
        $room->room=$request->Room;
        $room->hall_name=$hall->name;
        $data=$room->save();
        if ($data) {
            return redirect()->route('admin.hallRoom')->with('success','Successfully Add Room');
        }
    }

    public function addAdmissionRoll(Request $request)
    {
        Excel::import(new admissionRollImport, $request->file('roll'));
        return redirect()->route('admin.admissionRoll')->with('success','Successfully Add Data');
    }

    public function controller()
    {
        $data=Admin::role('controller')->get();
        return view('controllerHome',compact('data'));
    }

    public function addController()
    {
        return view('addController');
    }

    public function ControllerCreate(Request $request)
    {
        $request->validate([
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Email'=>'required|unique:admins,email',
            'Number'=>'required',
            'password'=>'required|min:8|max:16',
            'cpassword' => 'required|same:password',
        ]);
        $new=new Admin();
        $new->fname=$request->First_Name;
        $new->lname=$request->Last_Name;
        $new->email=$request->Email;
        $new->phone=$request->Number;
        $new->password=Hash::make($request->password);
        $data=$new->save();
        if ($data) {
            $new->assignRole('controller');
            return redirect()->route('admin.controller')->with('success','Add Successfully Controller');
        }
    }

    public function editController(Request $request)
    {
        $data=Admin::find($request->id);
        return view('editController', compact('data'));
    }

    public function editControllerData(Request $request)
    {
        $request->validate([
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Number'=>'required',
        ]);

        $update=Admin::where('id',$request->id)->update([
            'fname'=>$request->First_Name,
            'lname'=>$request->Last_Name,
            'phone'=>$request->Number
        ]);

        if ($update) {
            return redirect()->route('admin.controller')->with('success','Successfully Update Controller');
        }
        else {
            return redirect()->back()->with('err','Controller Not Update');
        }
    }

    public function deleteController(Request $request)
    {
        $delete=Admin::where('id',$request->id)->delete();
        return "Success";
    }


    public function teacherHome(Request $request)
    {
        $user=Auth::guard('admin')->user()->email;
        $dept=Chairman::where('email',$user)->first()->department;
        $data=Admin::where('dept',$dept)->role('teacher')->get();
        return view('teacherHome',compact('data'));
    }

    public function TeacherCreate(Request $request)
    {
        $request->validate([
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Number'=>'required',
            'Email'=>'required',
            'password'=>'required|min:8|max:16',
            'cpassword' => 'required|same:password',
        ]);
        $user=Admin::where('email', $request->Email)->role('teacher')->first();
        if ($user) {
            return redirect()->back()->with('err', "This Office Staff is Already Exists");
        }
        else{
            $user=Admin::where('email',$request->Email)->first();
            if ($user) {
                $user->assignRole('teacher');
                return redirect()->route('admin.teacherHome')->with('success','Successfully Add Teacher');
            }
            else {
                $me = Auth::guard('admin')->user()->email;
                $dept = Chairman::where('email', $me)->first()->department;
                $new=new Admin();
                $new->fname=$request->First_Name;
                $new->lname=$request->Last_Name;
                $new->email=$request->Email;
                $new->dept=$dept;
                $new->phone=$request->Number;
                $new->password=Hash::make($request->password);
                $data=$new->save();
                if ($data) {
                    $new->assignRole('teacher');
                    return redirect()->route('admin.teacherHome')->with('success','Successfully Add Teacher');
                }
            }
        }
    }

    public function editTeacher(Request $request)
    {
        $id=$request->id;
        $data=Admin::where('id',$id)->first();
        return view('editTeacher', compact('data'));
    }

    public function editTeacherData(Request $request)
    {
        $request->validate(
        [
            "First_Name" => "required",
            "Last_Name" => "required",
            "Number" => "required",
            "Email" => "required",
        ]);
        $update=Admin::where('id',$request->id)->update([
            'fname'=>$request->First_Name,
            'lname'=>$request->Last_Name,
            'phone'=>$request->Number,
            'email'=>$request->Email,
        ]);
        if ($update) {
            return redirect()->route('admin.teacherHome')->with('success','Successfully Update Teacher Info');
        }
        else {
            return redirect()->back()->with('err', "Not Update Teacher Info");
        }
    }

    public function teacherDelete(Request $request)
    {
        $exist=Admin::find($request->id);
        $exist->removeRole('teacher');
        Admin::where('id', $request->id)->delete();
        return "success";
    }

    public function ExamRegistration()
    {
        $data = Session::orderBy('session', 'desc')->get();
        $professionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
        return view('ExamRegistrationStatus',compact('data','professionalSession'));
    }

    public function admissionReport()
    {
        $data = Session::orderBy('session', 'desc')->get();
        $ProfessionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
        return view('admissionReport', compact('data','ProfessionalSession'));
    }

    public function exportRegistrationPdf(Request $request)
    {
        $user=Auth::guard('admin')->user();
        if ($user->hasRole('controller')) {
            $request->validate([
            'Department'=>'required',
            'Exam'=>'required',
            'Exam_Category'=>'required',
            'Program_Type'=>'required',
            'Session'=>'required',
            'Class'=>'required',
            'Semester'=>'required',
            ]);
        }
        elseif ($user->hasRole('admin')) {
            $request->validate([
            'Session'=>'required',
            'Class'=>'required',
            'Semester'=>'required',
            ]);
        }
        if ($user->hasRole('controller')) {
            $data=array();
            $exam=Exam::where('Department',$request->Department)
            ->where('Exam',$request->Exam)
            ->where('Exam_Category',$request->Exam_Category)
            ->where('Degree_Level',$request->Class)
            ->where('Program_type',$request->Program_Type)
            ->where('Semester',$request->Semester)
            ->get();
            foreach ($exam as $item) {
                foreach ((array)json_decode($item->Current_Session) as $item2) {
                    if ($item2==$request->Session) {
                        $data[]=$item;
                    }
                }
            }
        }
        elseif ($user->hasRole('admin')) {
            $data=Admission::where('Subject',$user->dept)
            ->where('Class',$request->Class)
            ->where('Semester',$request->Semester)
            ->where('Session',$request->Session)
            ->get();
        }
        elseif ($user->hasRole('office')){
            if ($request->Exam) {
                $data=array();
                $exam=Exam::where('Department',$user->dept)
                ->where('Exam',$request->Exam)
                ->where('Exam_Category',$request->Exam_Category)
                ->where('Degree_Level',$request->Class)
                ->where('Program_type',$request->Program_Type)
                ->where('Semester',$request->Semester)
                ->get();
                foreach ($exam as $item) {
                    foreach ((array)json_decode($item->Current_Session) as $item2) {
                        if ($item2==$request->Session) {
                            $data[]=$item;
                        }
                    }
                }
            }
            else {
                $data=Admission::where('Subject',$user->dept)
                ->where('Class',$request->Class)
                ->where('Semester',$request->Semester)
                ->where('Session',$request->Session)
                ->get();
            }
        }
        // elseif ($user->hasRole('office') && $request->Exam) {
        //     $data=array();
        //     $exam=Exam::where('Department',$user->dept)
        //     ->where('Exam',$request->Exam)
        //     ->where('Exam_Category',$request->Exam_Category)
        //     ->where('Degree_Level',$request->Class)
        //     ->where('Program_type',$request->Program_Type)
        //     ->where('Semester',$request->Semester)
        //     ->get();
        //     foreach ($exam as $item) {
        //         foreach ((array)json_decode($item->Current_Session) as $item2) {
        //             if ($item2==$request->Session) {
        //                 $data[]=$item;
        //             }
        //         }
        //     }
        // }
        $pdf=new Dompdf();
        $pdf->loadHtml(view('ExamStudentReport',compact('data')));
        $pdf->setPaper('A4', 'Portrait');
        $pdf->render();
        return $pdf->stream('StudentReport');
    }
    
    public function hallCircular()
    {
        return view('hallCircular');
    }

    public function hallCircularData(Request $request)
    {
        $request->validate([
            'DateofBirth'=>'required',
            'type'=>'required',
            'Prefix'=>'required',
            'Suffix'=>'required',
            'description'=>'required',
        ]);
        $user=Auth::guard('admin')->user();
        if ($user->hasExactRoles('office')) {
            $new=new HallCircular();
            $new->dept=$user->dept;
            $new->circular=$request->description;
            $new->type=$request->type;
            $new->prefix=$request->Prefix;
            $new->suffix=$request->Suffix;
            $new->last_date=$request->DateofBirth;
            $data=$new->save();
            if ($data) {
                return redirect()->route('user.admin')->with('success','Successfully Add Circular');
            }
        }
        else {
            $hall=Hall::where('email',$user->email)->first();
            $exist=HallCircular::where('hall_name',$hall->name)->first();
            if ($exist) {
                $data=HallCircular::where('hall_name',$hall->name)->update([
                    'circular'=>$request->description,
                    'type'=>$request->type,
                    'prefix'=>$request->Prefix,
                    'suffix'=>$request->Suffix,
                    'type'=>$request->type,
                    'last_date'=>$request->DateofBirth,
                ]);
                if ($data) {
                    return redirect()->route('user.admin')->with('success','Successfully Add Circular');
                }
            }
            else{
                $new=new HallCircular();
                $new->hall_name=$hall->name;
                $new->circular=$request->description;
                $new->type=$request->type;
                $new->prefix=$request->Prefix;
                $new->suffix=$request->Suffix;
                $new->last_date=$request->DateofBirth;
                $data=$new->save();
                if ($data) {
                    return redirect()->route('user.admin')->with('success','Successfully Add Circular');
                }
            }
        }
    }

    public function circularView(Request $request)
    {
        $user=Auth::guard('admin')->user();
        $circular = HallCircular::where('id', $request->id)->first();
        $hall=Hall::where('name', $circular->hall_name)->first();
        if (!$hall) {
            $dept=Department::where('department',$circular->hall_name)->first();
            if ($user->dept=='FBS') {
                $role_bangla='ডিন';
                $role_eng='Dean';
            }
            else {
                $role_bangla='সভাপতি';
                $role_eng='Chairman';
            }
            return view('circularView', compact('circular','hall','dept','role_bangla','role_eng'));
        }
        else {
            $dept=Department::where('department',$hall->dept)->first();
            $role_bangla='প্রভোস্ট';
            $role_eng='Provost';
            return view('circularView', compact('circular','hall','dept','role_bangla','role_eng'));
        }
    }
}