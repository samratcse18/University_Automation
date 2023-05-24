<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Hall;
use App\Models\HallTotalStudent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Admission;
use App\Models\Department;
use App\Models\fileSubmission;
use App\Models\ApplicationData;
use App\Models\Fee;
use App\Models\Session;
use App\Models\Exam;
use App\Models\ProfessionalSession;
use App\Models\HallCircular;
use App\Models\SemesterCourse;
use Hash;
use Auth;
use Dompdf\Dompdf;
use Mpdf\Mpdf;
use PDF;
use File; 
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentController extends Controller
{

    public function Home()
    {
        $roll = Auth::guard('student')->user()->admission_roll;
        $data = Student::where('admission_roll', $roll)->where('RegistrationNumber', NULL)->first();
        return view('DashboardContent', compact('data'));
    }


    public function studentProfile()
    {
        $hall=Hall::all();
        // $dept=Department::all();
        return view('studentProfile',compact('hall'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('student')->user();
        $request->validate([
            "FirstName" => "required",
            "LastName" => "required",
            "Email" => "required",
            "Department" => "required",
            "Session" => "required",
            "Student_Id" => "required",
            "Admission_Roll" => "required",
            "Phone" => "required",
            "Gender" => "required",
            "RegistrationNumber" => "required",
            "ApplicantName" => "required",
            "FatherName" => "required",
            "MotherName" => "required",
            "PermanentAddress" => "required",
            "CurrentAddress" => "required",
            "GuardianName" => "required",
            "GuardianNumber" => "required",
            "Nationality" => "required",
            "Religion" => "required",
            "BloodGroup" => "required",
            "DateofBirth" => "required",
            "MarriedStatus" => "required",
        ]);
        if ($request->img) {
            $request->validate([
                    'img'=>'required|mimes:jpg,png,jpeg|max:1024',
            ]);
        }
        if ($request->signature) {
            $request->validate([
                'signature'=>'required|mimes:jpg,png,jpeg|max:1024',
            ]);
        }
        if ($request->password) { 
            $request->validate([
                "cpassword"=>"same:password"
            ]);
        }
        
        if ($request->img) {
            $path=public_path('images/'.$user->img);
            File::delete($path);
            $upload_path = public_path('images');
            $file_name = $request->file('img')->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file('img')->getClientOriginalExtension();
            $submit = $request->file('img')->move($upload_path, $generated_new_name);
            $data=Student::where('admission_roll', $user->admission_roll)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "dept" => $request->Department,
                "session" => $request->Session,
                "student_id" => $request->Student_Id,
                "admission_roll" => $request->Admission_Roll,
                "phone" => $request->Phone,
                "gender" => $request->Gender,
                "Hall" => $request->Hall_Name,
                "RegistrationNumber" => $request->RegistrationNumber,
                "ApplicantName" => $request->ApplicantName,
                "FatherName" => $request->FatherName,
                "MotherName" => $request->MotherName,
                "PermanentAddress" => $request->PermanentAddress,
                "CurrentAddress" => $request->CurrentAddress,
                "GuardianName" => $request->GuardianName,
                "GuardianNumber" => $request->GuardianNumber,
                "Nationality" => $request->Nationality,
                "Religion" => $request->Religion,
                "BloodGroup" => $request->BloodGroup,
                "Birth" => $request->DateofBirth,
                "MarriedStatus" => $request->MarriedStatus,
                "img"=>$generated_new_name,
            ]);
            if ($data) {
                if($request->password)
                {
                Student::where('admission_roll', $user->admission_roll)->update(["password"=>Hash::make($request->password)]);
                };
                return redirect()->route('user.student')->with('success', 'Successfully Update Profile');
            }

        }
        else if ($request->signature && $user->signature) {
            $path=public_path('images/'.$user->signature);
            File::delete($path);
            $upload_path = public_path('images');
            $file_name = $request->file('signature')->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file('signature')->getClientOriginalExtension();
            $submit = $request->file('signature')->move($upload_path, $generated_new_name);
            $data=Student::where('admission_roll', $user->admission_roll)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "dept" => $request->Department,
                "session" => $request->Session,
                "student_id" => $request->Student_Id,
                "admission_roll" => $request->Admission_Roll,
                "phone" => $request->Phone,
                "gender" => $request->Gender,
                "RegistrationNumber" => $request->RegistrationNumber,
                "ApplicantName" => $request->ApplicantName,
                "FatherName" => $request->FatherName,
                "MotherName" => $request->MotherName,
                "PermanentAddress" => $request->PermanentAddress,
                "CurrentAddress" => $request->CurrentAddress,
                "GuardianName" => $request->GuardianName,
                "GuardianNumber" => $request->GuardianNumber,
                "Nationality" => $request->Nationality,
                "Religion" => $request->Religion,
                "BloodGroup" => $request->BloodGroup,
                "Birth" => $request->DateofBirth,
                "MarriedStatus" => $request->MarriedStatus,
                "signature" => $generated_new_name,
            ]);
            if ($data) {
                if($request->password)
                {
                Student::where('admission_roll', $user->admission_roll)->update(["password"=>Hash::make($request->password)]);
                };
                return redirect()->route('user.student')->with('success', 'Successfully Update Profile');
            }
        }
        else if ($request->signature && empty($user->signature)) {
            $upload_path = public_path('images');
            $file_name = $request->file('signature')->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file('signature')->getClientOriginalExtension();
            $submit = $request->file('signature')->move($upload_path, $generated_new_name);
            $data=Student::where('admission_roll', $user->admission_roll)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "dept" => $request->Department,
                "session" => $request->Session,
                "student_id" => $request->Student_Id,
                "admission_roll" => $request->Admission_Roll,
                "phone" => $request->Phone,
                "gender" => $request->Gender,
                "Hall" => $request->Hall_Name,
                "RegistrationNumber" => $request->RegistrationNumber,
                "ApplicantName" => $request->ApplicantName,
                "FatherName" => $request->FatherName,
                "MotherName" => $request->MotherName,
                "PermanentAddress" => $request->PermanentAddress,
                "CurrentAddress" => $request->CurrentAddress,
                "GuardianName" => $request->GuardianName,
                "GuardianNumber" => $request->GuardianNumber,
                "Nationality" => $request->Nationality,
                "Religion" => $request->Religion,
                "BloodGroup" => $request->BloodGroup,
                "Birth" => $request->DateofBirth,
                "MarriedStatus" => $request->MarriedStatus,
                "signature" => $generated_new_name,
            ]);
            if ($data) {
                if($request->password)
                {
                Student::where('admission_roll', $user->admission_roll)->update(["password"=>Hash::make($request->password)]);
                };
                return redirect()->route('user.student')->with('success', 'Successfully Update Profile');
            }
        }
        else{
            $data = Student::where('admission_roll', $user->admission_roll)->update([
                "fname" => $request->FirstName,
                "lname" => $request->LastName,
                "email" => $request->Email,
                "dept" => $request->Department,
                "session" => $request->Session,
                "student_id" => $request->Student_Id,
                "admission_roll" => $request->Admission_Roll,
                "phone" => $request->Phone,
                "gender" => $request->Gender,
                "Hall" => $request->Hall_Name,
                "RegistrationNumber" => $request->RegistrationNumber,
                "ApplicantName" => $request->ApplicantName,
                "FatherName" => $request->FatherName,
                "MotherName" => $request->MotherName,
                "PermanentAddress" => $request->PermanentAddress,
                "CurrentAddress" => $request->CurrentAddress,
                "GuardianName" => $request->GuardianName,
                "GuardianNumber" => $request->GuardianNumber,
                "Nationality" => $request->Nationality,
                "Religion" => $request->Religion,
                "BloodGroup" => $request->BloodGroup,
                "Birth" => $request->DateofBirth,
                "MarriedStatus" => $request->MarriedStatus,
            ]);
            if ($data) {
                if($request->password)
                {
                Student::where('admission_roll', $user->admission_roll)->update(["password"=>Hash::make($request->password)]);
                };
                return redirect()->route('user.student')->with('success', 'Successfully Update Profile');
            }
        }
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|unique:students,email|exists:admission_rolls,email',
                'dept' => 'required',
                'Session' => 'required',
                'admission_roll' => 'required|unique:students,admission_roll|exists:admission_rolls,admission_roll',
                'password' => 'required|min:8|max:16',
                'cpassword' => 'required|same:password',
                'image' => 'required|mimes:jpg,png,jpeg|max:2097152'
            ],
            [
                'admission_roll.unique' => 'Admission Roll is Already Exist',
                'admission_roll.exists' => 'Your Admission Roll is Invalid Please Contact Your Department Office',
            ]
        );
        $user=Student::where('email',$request->email)->first();
        if ($user) {
            return redirect()->back()->with('err', "This Email is All Ready registered");
        }
        else
        {
            $upload_path = public_path('images');
            $file_name = $request->image->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->image->getClientOriginalExtension();
            $submit = $request->image->move($upload_path, $generated_new_name);
            if ($submit) {
                $student = new Student();
                $student->fname = $request->fname;
                $student->lname = $request->lname;
                $student->email = $request->email;
                $student->dept = $request->dept;
                $student->session = $request->Session;
                $student->admission_roll = $request->admission_roll;
                $student->gender = $request->gender;
                $student->password = Hash::make($request->password);
                $student->img = $generated_new_name;
                $student->verify = 'deactive';
                $data = $student->save();
                $details = [
                    "roll" => $request->admission_roll,
                ];
                \Mail::to($request->email)->send(new \App\Mail\TestMail($details));
                $student->assignRole('student');
                if ($data) {
                    return redirect()->route('user.login')->with('success', 'Please Check Your Email And Verify Your Account');
                }
            } else {
                return redirect()->back()->with('error', "you Have not Successfully registered");
            }
        }
        
    }

    public function mailVerify($roll)
    {
        $student = Student::where("admission_roll", $roll)->update(['verify' => 'active']);
        return redirect()->route('user.login')->with('success', 'Successfully Verify');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }

    public function step($id)
    {

        $data['id'] = $id;
        return view('studentadmission', $data);
    }

    public function pdf(Request $request)
    {
        $admission=Admission::find($request->id);
        $user=Auth::guard('student')->user();
        if ($user->dept=='FBS') {
            $container=Fee::whereIn('fee_for',[$user->dept])->whereIn('type',['Admission'])->get();
        }
        else{
            $container=Fee::whereIn('fee_for',['varsity',$user->dept])->whereIn('type',['Admission'])->get();
        }
        $data=array();
        foreach ($container as $item) {
            foreach ((array)json_decode($item->semester) as $item2) {
                if ($item2==$admission->Semester) {
                    $data[]=$item;
                }
            }
        }
        
        $pdf=new Dompdf();
        $pdf->loadHtml(view('studentPdf',compact('data','admission')));
        $pdf->setPaper('A4', 'Portrait');
        $pdf->render();
        // $pdf=new Mpdf(['format'=>'A4','orientation'=>'p', 'margin_left' => 3,'margin_right' => 3,'margin_top' => 3,'margin_bottom' => 3,'default_font' =>'bangla','mode'=>'utf-8']);
        // // $pdf->AddFont('sutonnymj', '', '', $fontdata);
        // // $pdf->SetDefaultFont('sutonnymj');
        // $pdf->WriteHTML(view('studentPdf',compact('data','admission'))->render());
        // return $pdf->Output();
        // $pdf = PDF::loadView('studentPdf',compact('data','admission'));
        return $pdf->stream('paySlip.pdf');
    }

    public function upload(Request $request)
    {
        $user=Auth::guard('student')->user();
        $upload_path = public_path('images');
        $file_name = $request->file->getClientOriginalName();
        $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        $submit = $request->file->move($upload_path, $generated_new_name);
        if ($submit) {
            $data = new fileSubmission();
            $data->department = $user->dept;
            $data->semester = $request->Semester;
            $data->course = $request->course;
            $data->roll = $user->student_id;
            $data->file_name = $generated_new_name;
            $data->save();
            return 'Successfully Submission';
        }
    }
    public function applicationData(Request $request)
    {
        $data = new ApplicationData;
        $data->department = $request->department;
        $data->application = $request->application;
        $data->year = $request->year;
        $data->semester = $request->semester;
        $data->roll = $request->id;
        $data->text = $request->text;
        $data->save();
        return 'Successfully Submission';
    }
    

    public function admission()
    {
        $data = Session::orderBy('session', 'desc')->get();
        $ProfessionalSession = ProfessionalSession::orderBy('professional_session', 'desc')->get();
        return view('studentAdmission', compact('data','ProfessionalSession'));
    }

    public function admissionLevel(Request $request)
    {
        $user=Auth::guard('student')->user();
        $faculty=Department::where('department',$user->dept)->first();
        if ($request->type=='Regular') {
            $data = Degree::where('class_level', $request->Class)->where('faculty',$faculty->faculty)->where('degree_name', '!=', 'null')->get();
        }
        else if ($request->type=='Professional') {
            $data = Degree::where('class_level', $request->Class)->where('faculty',$faculty->faculty)->where('special_degree', '!=', 'null')->get();
        }
        return response($data);
    }

    public function admissionData(Request $request)
    {
        if ($request->type=="Regular") {
            if ($request->Class=="Under Graduation") {
                        $request->validate([
                            "Session"=>"required",
                            "Class"=>"required",
                            "Program"=>"required",
                            "Year_Semester"=>"required",
                        ]);
            }
            elseif ($request->Class=="Post Graduation") {
                $request->validate([
                "Session"=>"required",
                "Class"=>"required",
                "Program"=>"required",
                "Semester"=>"required",
            ]);
            }
        }
        else {
                if ($request->Class=="Under Graduation") {
                        $request->validate([
                            "professional_session"=>"required",
                            "Class"=>"required",
                            "Program"=>"required",
                            "Year_Semester"=>"required",
                        ]);
                        }
            elseif ($request->Class=="Post Graduation") {
                $request->validate([
                "professional_session"=>"required",
                "Class"=>"required",
                "Program"=>"required",
                "Semester"=>"required",
            ]);
            }
        }
        
        $user=Auth::guard('student')->user();
        if (empty($user->student_id)&&empty($user->RegistrationNumber)) {
            return redirect()->back()->with('err','Your Profile Update First');
        }
        else {
            $data = new Admission();
            $data->Class = $request->Class;
            $data->program = $request->Program;
            if ($request->Class=="Post Graduation") {
                $data->Semester = $request->Semester;
            }
            else {
                $data->Semester = $request->Year_Semester;
            }
            $data->Subject = $user->dept;
            if ($request->Year_Semester=="1st Year-1st Semester") {
                $data->RollNumber = $user->admission_roll;
            }
            else {
                $data->RollNumber = $user->student_id;
            }
            $data->RegistrationNumber = $user->RegistrationNumber;
            if ($request->type=="Regular") {
                $data->Session = $request->Session;
            }
            else {
                $data->Session = $request->professional_session;
            }
            $data->ApplicantName = $user->ApplicantName;
            $data->FatherName = $user->FatherName;
            $data->MotherName = $user->MotherName;
            $data->PermanentAddress = $user->PermanentAddress;
            $data->CurrentAddress = $user->CurrentAddress;
            $data->PhoneNumber = $user->phone;
            $data->Email = $user->email;
            $data->GuardianName = $user->GuardianName;
            $data->GuardianCurrentPhoneNumber = $user->GuardianNumber;
            $data->Nationality = $user->Nationality;
            $data->Religion = $user->Religion;
            $data->BloodGroup = $user->BloodGroup;
            $data->DateofBirth = $user->Birth;
            $data->MarriedStatus = $user->MarriedStatus;
            $data->status = 'pending';
            $data->token = '200'.time();
            $datasend = $data->save();
            if ($datasend) {
                return view('paySlipView',compact('data'))->with('success','Successfully Submission');
            }
        }
    }

    public function applyHall()
    {   
        // $user = Auth::guard('student')->user();
        // $circular = HallCircular::where('hall_name', $user->Hall)->first();
        // $pdf=new Mpdf(['format'=>'A4','orientation'=>'p', 'margin_left' => 3,'margin_right' => 3,'margin_top' => 3,'margin_bottom' => 3,'default_font' =>'bangla','mode'=>'utf-8']);
        // $pdf->WriteHTML(view('testpdf',compact('circular'))->render());
        // return $pdf->Output();
        return view('applyHall');
    }

    public function sendApplyHallData(Request $request)
    {
        $student = new HallTotalStudent();
        $student->hall_name = Auth::guard('student')->user()->Hall;
        $student->student_id = Auth::guard('student')->user()->id;
        $student->status = 'pending';
        $data = $student->save();
        if ($data) {
            return redirect()->route('student.applyHall');
        }
    }

    public function ExamRegistration()
    {
        $session = Session::orderBy('session', 'desc')->get();
        $ProfessionalSession=ProfessionalSession::orderBy('professional_session', 'desc')->get();
        return view('ExamRegistration',compact('session','ProfessionalSession'));
    }

    public function examRegistrationData(Request $request)
    {
        
        $user=Auth::guard('student')->user();
        if (empty($user->signature)) {
            return redirect()->back()->with('err','Please Add Your Signature First');
        }
        else {
            $request->validate([
            'Exam'=>'required',
            'Exam_Category'=>'required',
            'Degree_Level'=>'required',
            'Program_type'=>'required',
            'Program_Name'=>'required',
            'Current_Session'=>'required',
            'Semester'=>'required',
            'course'=>'required',
            ]);
            $save=new Exam();
            $save->Department=$user->dept;
            $save->Name=$user->fname.' '.$user->lname;
            $save->student_id=$user->student_id;
            $save->Exam=$request->Exam;
            $save->Exam_Category=$request->Exam_Category;
            $save->Degree_Level=$request->Degree_Level;
            $save->Program_type=$request->Program_type;
            $save->Program_Name=$request->Program_Name;
            $save->Current_Session=json_encode($request->Current_Session);
            $save->Semester=$request->Semester;
            $save->course=json_encode($request->course);
            $save->token='100'.time();
            $save->status='pending';
            $exam=$save->save();
            if ($exam) {
                $data=$save;
                return view('examPaySlipView', compact('data'));
            }
        }
        
    }

    public function program_type(Request $request)
    {
        $user=Auth::guard('student')->user();
        if ($request->Program_type=='Regular') {
            $degree=DB::table('departments')
            ->where('departments.department',$user->dept)
            ->join('degrees','degrees.faculty','=','departments.faculty')
            ->where('degrees.degree_name','!=','null')
            ->select('degrees.degree_name')
            ->get();
            return view('search.degreeName', compact('degree'));
        }
        else{
            $degree=DB::table('departments')
            ->where('departments.department',$user->dept)
            ->join('degrees','degrees.faculty','=','departments.faculty')
            ->where('degrees.special_degree','!=','null')
            ->select('degrees.special_degree')
            ->get();
            return view('search.specialDegreeName', compact('degree'));
        }
    }
    
    public function course(Request $request)
    {
        $user=Auth::guard('student')->user();
        if ($request->Exam_Category=='Current Semester') {
            $data=SemesterCourse::where('dept_name',$user->dept)->where('semester',$request->Semester)->get();
            return view('search.course', compact('data'));
        }
        else if($request->Exam_Category=='Improvement' || $request->Exam_Category=='Backlog'){
            $data=SemesterCourse::where('dept_name',$user->dept)->where('semester',$request->Semester)->get();
            return view('search.improveAndBacklogCourse', compact('data'));
        }

        if ($request->Program_Level=='Under Graduation' || $request->Program_Level=='Post Graduation') {
            $data=SemesterCourse::where('dept_name',$user->dept)->where('semester',$request->Semester)->get();
            return view('search.fileSubmission_course', compact('data'));
        }

    }

    public function examPdf(Request $request)
    {
        $user=Auth::guard('student')->user();
        $data=Exam::find($request->id);
        $totalCredit=0;
        foreach ((array)json_decode($data->course) as $item) {
            $credit=SemesterCourse::where('course_code',$item)->first();
            $totalCredit=$totalCredit+$credit->course_credit;
        }
        $fee=Fee::where('fee_title','Credit Fee')->first();
        if ($fee) {
            $totalCreditFee=$totalCredit*$fee->amount;
        }
        else {
            $totalCreditFee=0;
        }
        if ($user->dept=='FBS') {
            $fee=Fee::whereIn('fee_for',[$user->dept])
            ->where('class',$data->Degree_Level)
            ->where('type','Exam')
            ->get();
        }
        else{
            $fee=Fee::whereIn('fee_for',['varsity',$user->dept,'controller'])
            ->where('class',$data->Degree_Level)
            ->where('type','Exam')
            ->get();
        }
        $pdf=new Dompdf();
        $pdf->loadHtml(view('examPdf',compact('data','fee','totalCreditFee')));
        $pdf->setPaper('A4', 'Portrait');
        $pdf->render();
        return $pdf->stream('paySlip.pdf');
        // // $pdf = PDF::loadView('studentPdf',compact('data','admission'))->setPaper('A4', 'Portrait');
    }


    public function hallPayslip()
    {
        $user=Auth::guard('student')->user();
        $fee=Fee::where('fee_for',$user->Hall)->get();
        $data=HallTotalStudent::where('student_id',$user->id)->first();
        $pdf=new Dompdf();
        $pdf->loadHtml(view('hallPayslip',compact('data','fee')));
        $pdf->setPaper('A4', 'Portrait');
        $pdf->render();
        return $pdf->stream('paySlip.pdf');
    }

    public function billingSlip(Request $request)
    {
        // $month=(date('Y')-date('Y',strtotime($hall->payment)))*12+(date('m')-date('m',strtotime($hall->payment)));
        $user=Auth::guard('student')->user();
        $fee=Fee::where('fee_for',$user->Hall)->get();
        $data=HallTotalStudent::where('student_id',$user->id)->first();
        $month=decrypt($request->M);
        // foreach ($get as $item) {
        //     $fee= $item->amount * ;
        // }
        $pdf=new Dompdf();
        $pdf->loadHtml(view('hallMonthlyPaySlip',compact('data','fee','month')));
        $pdf->setPaper('A4', 'Portrait');
        $pdf->render();
        return $pdf->stream('paySlip.pdf');
    }

    public function circularView(Request $request)
    {
        $user=Auth::guard('admin')->user();
        $circular = HallCircular::where('id', $request->id)->first();
        if ($user) {
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
        else {
            $student=Auth::guard('student')->user();
            $dept=Department::where('department',$student->dept)->first();
            if ($student->dept=='FBS') {
                $role_bangla='ডিন';
                $role_eng='Dean';
            }
            else {
                $role_bangla='সভাপতি';
                $role_eng='Chairman';
            }
            return view('circularView', compact('circular','dept','role_bangla','role_eng'));
        }
    }
}