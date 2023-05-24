<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\MeetingLetter;
use App\Models\DeptInfo;
use App\Models\LetterSend;
use App\Models\MediumCertificate;
use App\Models\Testimonial;
use App\Models\MeetingAgenda;
use App\Models\Student;
use App\Models\ReferenceLetter;
use App\Models\SemesterCourse;
use App\Models\DeptRoom;
use App\Models\Department;
use App\Models\Degree;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\Chairman;
use App\Models\ClassRoutine;
use App\Models\RoutineInfo;
use App\Models\Admission;
use App\Models\Session;
use App\Models\Faculty;
use App\Models\PresentStudentStatus;
use App\Models\ProfessionalSession;
use App\Models\SemesterDuration;
use App\Models\Syllabus;
use Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMeetingLetter;
use Illuminate\Support\Facades\Response;
use App\Mail\SendMeetingLetterFiveElement;
class OfficeController extends Controller
{
    //dept room
    public function roomList(){
        $auth =Auth::user();
        $data['dept_rooms'] =  DeptRoom::where('dept_name','=',$auth->dept)->get();
        return view('department.office.dept_room_list',$data);
    }
    public function roomCreateView(){
        return view('department.office.room_create_view');
    }
    public function roomCreateSave(Request $request){
        $auth = Auth::user();
        $building_name = $request->building_name;
        $room_number = $request->room_number;
        $predefine = DeptRoom::where('building_name','=',$building_name)
                    ->where('dept_room_number','=',$room_number)
                    ->first();

        
        if($predefine){
            $dept_ = strtoupper($predefine->dept_name);
            return redirect()->route('dept.roomlist')->with('warning',$dept_.' Department All-ready Selected '.$predefine->dept_room_number.' Number Room');
        }else{
            $dept_room = new DeptRoom();
            $dept_room->dept_name = $auth->dept;
            $dept_room->dept_room_number = $room_number;
            $dept_room->building_name = $building_name;
            $result = $dept_room->save();
            if($result){
                return redirect()->route('dept.roomlist')->with('success','Room Selected');
            }else{
                return redirect()->route('dept.roomlist')->with('error','Some wrong');
            }
        }
        
    }
    //course
    public function deptCourse(){
        $auth= Auth::user();
        $data['session_year_semester'] =SemesterCourse::select('session_year','semester')
                                        ->groupBy('session_year','semester')
                                        ->where('dept_name','=',$auth->dept)
                                        ->orderBy('session_year','desc')
                                        ->get();
        $data['dept_course'] = SemesterCourse::where('dept_name','=',$auth->dept)->get();
        return view('department.office.dept_course_view',$data);
    }
    public function courseCreateView(){
        $data['regular_session'] = Session::get();
        return view('department.office.dept_course_create',$data);
    }
    public function programTypeSession($program_type){
        $type = $program_type;
        if($type == '1'){
            $data['sessions'] = Session::get();
        }else if($type == '2'){
            $data['sessions'] = ProfessionalSession::get();
        }
        $data['type'] = $type;
        return view('department.office.session',$data);
        
    }
    public function ClassNameToProgram($class_name){
        $auth = Auth::user();
        $class = $class_name;
        $faculty = Department::where('department','=',$auth->dept)->first();
        
        $data['dept_degree'] = Degree::where('faculty','=',$faculty->faculty)
                            ->where('class_level','=',$class)->get();
        $data['class'] = $class;
        return view('department.office.program_list',$data);
    }
    public function classNameToProgramCourseCode($student_type,$batch_session,$class_name,$semester){
        $auth =Auth::user();
        $data['semeste_course'] = SemesterCourse::where('dept_name','=',$auth->dept)
                                ->where('session_year','=',$batch_session)
                                ->where('semester','=',$semester)
                                ->where('class_name','=',$class_name)
                                ->where('student_type','=',$student_type)->get();
        return view('department.letter_layouts.get_course_list1',$data);
    }
    public function courseCreateSave(Request $request){
        $request->validate([
            'student_type' =>'required',
            'batch_session' =>'required',
            'class_name' =>'required',
            'program_name' =>'required',
            'semester' =>'required',
            'course_code' =>'required',
            'course_name' =>'required',
            'course_credit' =>'required',
            'contact_hours' =>'required',
            ]);
        $auth = Auth::user();
        $check_course = SemesterCourse::where('dept_name','=',$auth->dept)
                        ->where('session_year','=',$request->batch_session)
                        ->where('semester','=',$request->semester)
                        ->where('student_type','=',$request->student_type)
                        ->where('class_name','=',$request->class_name)
                        ->where('degree_id','=',intval($request->program_name))
                        ->where('course_code','=',$request->course_code)->first();
        if($check_course){
            return redirect()->route('dept_course')->with('warning','This course alreay create');
        }else{
            $course =new SemesterCourse();
            $course->dept_name = $auth->dept;
            $course->session_year = $request->batch_session;
            $course->semester =$request->semester;
            $course->course_code = $request->course_code;
            $course->course_name = $request->course_name;
            $course->course_credit = strval($request->course_credit);
            
            $course->student_type = $request->student_type;
            $course->class_name = $request->class_name;
            $course->degree_id = intval($request->program_name);
            $course->weekly_hours = $request->contact_hours;
            $course->major = $request->majorcourse;
            $result = $course->save();
            if($result){
                return redirect()->back()->with('success','Course Add Successfully');
            }else{
                return redirect()->route('dept_course')->with('err','Some fill error');
            }
        }
        
        
        
        
    }
    public function courseUpdate(Request $request,$course_id){
        $course_code = $request->course_code;
        $course_name = $request->course_name;
        $course_credit = $request->course_credit;
        if(empty($course_code) and empty($course_name) and empty($course_credit)){
            $delete_data = SemesterCourse::where('id','=',$course_id)->delete();
            if($delete_data){
                return redirect()->route('dept_course')->with('success','Delete Successfully');
            }
        }else{
            $checkCourse = SemesterCourse::where('id','=',$course_id)->update(['course_code'=>$course_code,'course_name'=>$course_name,'course_credit'=>strval($course_credit)]);
            if($checkCourse){
                return redirect()->route('dept_course')->with('success','Update Successfully');
            }else{
                return redirect()->route('dept_course')->with('warning','Some Problem');
            }
        }
        
    }
    
    // Syllabus
    public function deptSyllabusList(){
        $auth = Auth::user();
        $dept = Department::where('department','=',$auth->dept)->first();
        $data['syllabus'] = Syllabus::where('dept_id','=',$dept->id)->get();
        return view('department.office.syllabus_list',$data);
    }
    public function deptSyllabusCreateView(){
        $auth = Auth::user();
        $dept = Department::where('department','=',$auth->dept)->first();
        $syllabus = Syllabus::where('dept_id','=',$dept->id)->get();
        $data =[];
        foreach($syllabus as $say){
            $data[] = $say->session_year;
        }
        $data['regular_session'] = Session::whereNotIN('session',$data)->get();
        return view('department.office.syllabus_create_view',$data);
    }
    public function deptSyllabusCreate(Request $request){
        $request->validate([
            'student_type' =>'required',
            'class_name' =>'required',
            'program_name' =>'required',
            'batch_session' => 'required',
            'syllabus_file'=>'required|file|max:2048'
        ]);
        $auth = Auth::user();
        $dept = Department::where('department','=',$auth->dept)->first();
        if($request->file('syllabus_file')){
            $file_path = $request->file('syllabus_file');

            if($file_path->getClientOriginalExtension() == 'pdf'){
                $file_name = $request->batch_session.'-'.strtolower($auth->dept).'-'.$request->program_name.'-'.strtolower($request->class_name).'.'.$file_path->getClientOriginalExtension();
                $file_path->move(public_path('file/syllabus'),$file_name);
                $data = new Syllabus();
                $data->student_type = $request->student_type;
                $data->class_name = $request->class_name;
                $data->program_id = intval($request->program_name);
                $data->dept_id = $dept->id;
                $data->session_year = $request->batch_session;
                $data->syllabus_file = $file_name;
                $result = $data->save();
                if($result){
                    return redirect()->route('dept.deptSyllabusList')->with('success','Syllabus create successfully');
                }else{
                    return redirect()->back()->with('err','please add valid data');
                }
            }else{
                return redirect()->back()->with('err','submit file extention not pdf');
            }
        }else{
            return redirect()->back()->with('err','please add valid file');
        }
        
    }

    public function syllabusShow($file_path){
        $pdf_path = public_path('file/syllabus/'.$file_path);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return Response::download($pdf_path, 'syllabus.pdf', $headers);
    }
    
    
    //routine
    public function interTeacher(){
        $auth = Auth::user();
        $teachers = Admin::select('admins.*')
                    ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
                    ->whereIn('model_has_roles.role_id',['13'])
                    ->where('admins.dept','=',$auth->dept)->get();
        $data['teachers'] =$teachers;
        return view('department.letter_layouts.my_dept_teacher',$data);
    }
    public function getCallDeptTeacher($dept_name){
        $teachers = Admin::select('admins.*')
        ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
        ->whereIn('model_has_roles.role_id',['13'])
        ->where('admins.dept','=',$dept_name)->get();
        $data['teachers'] =$teachers;
        return view('department.letter_layouts.select_dept_teacher',$data);
    }
    public function getCourse($year,$semester,$session){
        $auth = Auth::user();
        $data['semeste_course'] = SemesterCourse::where('dept_name','=',$auth->dept)
                                ->where('course_year','=',$year)
                                ->where('session_year','=',$session)
                                ->where('course_semester','=',$semester)->get();
        return view('department.letter_layouts.get_course_list',$data);
    }
    
    public function selectRoomList(){
        $auth = Auth::user();
        $data['rooms'] = DeptRoom::where('dept_name','=',$auth->dept)->get();
        return view('department.letter_layouts.room_list',$data);
    }
    //get regular session
    public function regularSessionGet(){
        $data['sessions'] = Session::get();
        return view('department.letter_layouts.regular_session_list',$data);
    }
    // Routine
    
     public function presentYearSemester(Request $request){
        $auth = Auth::user();
        $info = PresentStudentStatus::where('dept_name','=',$auth->dept)->first();
        
        if(!empty($info)){
            $change = PresentStudentStatus::where('dept_name','=',$auth->dept)
                    ->update([
                        'student_type'=>intval($request->student_type),
                        'session_year'=>$request->session,
                        'semester'=>$request->semester,
                        'class_name'=>$request->class_name,
                        'program_id'=>intval($request->program_name)
                        ]);
            return !empty($change)?
                redirect()->back()->with('success','Update successfully'):
                redirect()->back()->with(['error'=>_('Something wrong')]);
        }else{
            $data = new PresentStudentStatus();
            $data->student_type =intval($request->student_type);
            $data->session_year =$request->session;
            $data->semester =$request->semester;
            $data->class_name =$request->class_name;
            $data->program_id =intval($request->program_name);
            $data->dept_name = $auth->dept;
            $result = $data->save();
            return !empty($result)?
                redirect()->back()->with(['success'=>__('create successfully')]):
                redirect()->back()->with(['error'=>__('Something wrong')]);
        }
        
    }
    
    public function officeRoutineList(){
        $auth = Auth::user();
        $present = PresentStudentStatus::where('dept_name','=',$auth->dept)->first();
        $data['present'] = $present;
        if($present){
            $data['program'] = Degree::where('id','=',$present->program_id)->first();
            $routine = RoutineInfo::select('class_routines.*','routine_infos.*','admins.*','class_routines.id as class_routine_id','admins.dept as teacher_dept','admins.fname as teacher_fname','admins.lname as teacher_lname','semester_courses.*','dept_rooms.*')
                    ->join('class_routines','class_routines.routine_info_id','=','routine_infos.id')
                    ->join('admins','admins.id','=','routine_infos.teacher_id')
                    ->join('dept_rooms','dept_rooms.id','=','class_routines.class_room')
                    ->join('semester_courses','semester_courses.id','=','routine_infos.course_id')
                    ->where('routine_infos.session_year','=',$present->session_year)
                    ->where('routine_infos.semester','=',$present->semester)
                    ->where('routine_infos.class_name','=',$present->class_name)
                    ->where('routine_infos.program_id','=',$present->program_id)
                    ->where('routine_infos.dept_name','=',$present->dept_name)
                    ->get();
            // dd($routine);
            $data['sunday'] = $routine->where('routine_day','=','Sun')->sortBy('class_time');
            $data['monday'] = $routine->where('routine_day','=','Mon')->sortBy('class_time');
            $data['tuesday'] = $routine->where('routine_day','=','Tue')->sortBy('class_time');
            $data['wednesday'] = $routine->where('routine_day','=','Wed')->sortBy('class_time');
            $data['thursday'] = $routine->where('routine_day','=','Thu')->sortBy('class_time');
            $data['friday'] = $routine->where('routine_day','=','Fri')->sortBy('class_time');
            $data['saturday'] = $routine->where('routine_day','=','Sat')->sortBy('class_time');
            
        }
        return view('department.office.routine',$data);
    }
    public function routineCreateView(){
        $auth = Auth::user();
        $depts = Admin::select('admins.dept')->groupBy('dept')->where('dept','!=',$auth->dept)->get();
        $data['semester_times'] = SemesterDuration::where('dept_name','=',$auth->dept)->where('semester_year','>=',date('Y'))->get();
        $data['depts'] =$depts; 
        return view('department.office.routine_create',$data);
    }

    public function routineCreateSave(Request $request){

        // $program = $request->program;
        // if($program == 'Regular'){
            $request->validate([
                'student_type'=>'required',
                'batch_session'=>'required',
                'class_name'=>'required',
                'program_name'=>'required',
                'semester'=>'required',
                'semester_duration'=>'required',
                'course_code'=>'required',
                'course_credit'=>'required',
            ]);
            $auth = Auth::user();
            $credit = count($request->room_number);
            $teacher_id;
            if($request->teacher_internal != ''){
                $teacher_id = $request->teacher_internal;
            }
            if($request->teacher_external_teacher !=''){
                $teacher_id = $request->teacher_external_teacher;
            }
            
            $status =0;
            if($credit > 0){
                for($i=0;$i<$credit;$i++){
                    $check_time = ClassRoutine::where('class_room','=',$request->room_number[$i])
                    ->where('class_time','=',$request->class_time[$i])
                    ->where('routine_day','=',$request->class_day[$i])->first();
                    if($check_time){
                        $status = 1;
                    }
                }
            }
            if($status == 0){
                $routine_info = [
                    'dept_name'=>$auth->dept,
                    'student_type'=>$request->student_type,
                    'class_name'=>$request->class_name,
                    'program_id'=>intval($request->program_name),
                    'session_year'=>$request->batch_session,
                    'semester'=>$request->semester,
                    'teacher_id'=>$teacher_id,
                    'semester_duration_id'=>intval($request->semester_duration),
                    'course_id'=>$request->course_code,
                    'course_credit'=>$request->course_credit,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $info_id = DB::table('routine_infos')->insertGetId($routine_info);
                for($i=0;$i<$credit;$i++){
                    ClassRoutine::create([
                        'routine_info_id' =>$info_id,
                        'routine_day' =>$request->class_day[$i],
                        'class_room' =>$request->room_number[$i] ,
                        'class_time' =>$request->class_time[$i],
                        'class_end_time' =>$request->end_time[$i]
                    ]);
                    
                }
                return redirect()->route('admin.routine')->with('success','selected');
            }else{
                return redirect()->route('admin.routine')->with('success','Room number or class day or time all-ready selected');
            }
        // }else{
        //     return redirect()->route('office.routineCreateView')->with('warning','program not support');
        // }
        
        
    }
    
    public function routineClassUpdateView($class_routine_id){
        
        
        
        $auth = Auth::user();
        $depts = Admin::select('admins.dept')->groupBy('dept')->where('dept','!=',$auth->dept)->get();
        $data['semester_times'] = SemesterDuration::where('dept_name','=',$auth->dept)->where('semester_year','>=',date('Y'))->get();
        $data['depts'] =$depts; 
        $data['course_info'] = ClassRoutine::select('routine_infos.*','degrees.*','degrees.id as degree_id')
                                ->join('routine_infos','routine_infos.id','=','class_routines.routine_info_id')
                                ->join('degrees','degrees.id','=','routine_infos.program_id')
                                ->where('class_routines.id','=',$class_routine_id)->first();
        return view('department.office.routine_update_view',$data);
    }
    public function allLetters(){
        $auth = Auth::user();
        $all_letters = MeetingLetter::where('dept_name','=',$auth->dept)->orderBy('id','DESC')->get();
        $data['all_letters'] = $all_letters;
        return view('department.office.allLetter',$data);
    }
    public function letterDeptTeacher($dept_name){
        $teachers = Admin::select('admins.*')
                ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
                ->where('model_has_roles.role_id','=','13')
                ->where('admins.dept','=',$dept_name)->get();
        $data['teachers'] = $teachers;
        return view('department.letter_layouts.meeting_teacher',$data);
        
    }
    public function leterWritingView(){
        $auth = Auth::user();
        $depts = Admin::select('admins.dept')->groupBy('dept')->where('dept','!=',$auth->dept)->get();
        $data['depts'] =$depts; 
        $data['dept_teacher'] = Admin::select('admins.*')
                                ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
                                ->whereIn('model_has_roles.role_id',['13'])
                                ->where('admins.dept','=',$auth->dept)->get();
        return view('department.office.letterWritingView',$data);
    }

    public function createLetter(Request $request){
        try{
            $auth = Auth::user();
            $request->validate([
                'meeting_name'=>'required',
                'meeting_date'=>'required',
                'meeting_time'=>'required',
                'builing_name'=>'required',
                'meeting_room_number'=>'required',
            ]);
            $letter_data=[
                'm_name' => $request->meeting_name,
                'm_date' => $request->meeting_date,
                'm_time'=> $request->meeting_time,
                'm_building_name' => $request->builing_name,
                'm_room_number' => $request->meeting_room_number,
                'dept_name' => $auth->dept,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $strd = $request->selectTeacher;
            $id = strlen($strd);
            $joinTeaceh = array();
            $aa = '';
            for($i=0;$i < $id;$i++){
                
                if($strd[$i] == ','){
                    array_push($joinTeaceh,intval($aa));
                    $aa = '';
                }else{
                    $aa .= $strd[$i];
                }
                
            }
            array_push($joinTeaceh,intval($aa));
            $meetingMember = Admin::whereIn('id',$joinTeaceh)->get();
            if(count($meetingMember) > 0){
                $letter_id = DB::table('meeting_letters')->insertGetId($letter_data);
                $meetngs = MeetingLetter::where('dept_name','=',$auth->dept);
                $letter_number = $meetngs->count();
                $dept = Department::where('department','=',$auth->dept)->first();
                $dept_chairman = Chairman::where('department','=',$auth->dept)->orderByDesc('id')->first();
                $letter= MeetingLetter::where('id','=',$letter_id)->first();
                if($request->meeting_agendas){
                    foreach($request->meeting_agendas as $agenda){
                        MeetingAgenda::create([
                            'meeting_id' =>$letter_id,
                            'dept_name'  =>$auth->dept,
                            'agenda_text'=>$agenda,
                        ]);
                    }
                    $agendas = MeetingAgenda::where('meeting_id','=',$letter_id)->get();
                    foreach($meetingMember as $teacher){
                        LetterSend::create([
                            'send_by' => $teacher->id,
                            'letter_id' => $letter_id,
                        ]);
                        Mail::to($teacher->email)->send(new SendMeetingLetter($dept,$dept_chairman,$letter,$agendas,$letter_number,$meetingMember));
                    }
                }else{
                    foreach($meetingMember as $teacher){
                        LetterSend::create([
                            'send_by' => $teacher->id,
                            'letter_id' => $letter_id,
                        ]);
                        Mail::to($teacher->email)->send(new SendMeetingLetterFiveElement($dept,$dept_chairman,$letter,$letter_number,$meetingMember));
                    }
                }

                return redirect()->route('office.letters')->with('success','Metting create successfully');
            }else{
                return redirect()->route('office.letters')->with('err','soome error');
            }
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('office.letters')->with('err','Letter not send');
        }
        
        
    }

    public function letterSendByMembers($id){
        $auth = Auth::user();
        $letter_id = $id;
        // $send_by = LetterSend::where('letter_id',$id)->get();
        $send_by = LetterSend::
                    join('admins','admins.id','=','letter_sends.send_by')
                    ->where('letter_id',$id)->get();
        $send_id = array();
        foreach($send_by as $id){
            array_push($send_id,intval($id->send_by));
            
        }
        $dept_members = Admin::where('dept', $auth->dept)->whereNotIn('id',$send_id)->get();
        error_log(count($dept_members));
        $data['members'] = $dept_members;
        $data['selected_member'] = $send_by;
        $data['letter_id'] = $letter_id;
        return view('department.office.letterSendByMembers',$data);
    }
    public function letterAddNewMembers(Request $request){

        
        $members = $request->member;
        $letter = $request->letter_id;

        for ($i=0; $i < count($members); $i++) {
            $letter_send = new LetterSend();
            $letter_send->send_by = $members[$i];
            $letter_send->letter_id = $letter;
            $letter_send->save();
        }
        return redirect()->back();
    }

    
    public function singleLetterView($id){
        $auth = Auth::user();
        $meetngs = MeetingLetter::where('dept_name','=',$auth->dept)->where('id','<=',$id);
        $data['sendMember'] = LetterSend::
                    join('admins','admins.id','=','letter_sends.send_by')
                    ->where('letter_id',$id)->get();
        $data['letter_number'] = $meetngs->count();
        $data['dept'] = Department::where('department','=',$auth->dept)->first();
        $data['dept_chairman'] = Chairman::where('department','=',$auth->dept)->orderByDesc('id')->first();
        $data['letter']= MeetingLetter::select('meeting_letters.*','meeting_letters.created_at as create_date')
                        ->where('meeting_letters.id','=',$id)->first();
        $data['agendas'] = MeetingAgenda::where('meeting_id','=',$id)->where('dept_name','=',$auth->dept)->get();
        $pdf = PDF::loadView('department.letter_layouts.letter',$data);
        return $pdf->stream();

    }
    // meeting decision
    public function meetingMinsView(){
        return view('department.office.meetingMinsView');
    }

    public function meetingdecisionCreateView($id){
        $data['letter_id'] = $id;
        $data['letter_sends'] = LetterSend::select('letter_sends.*','admins.*','admins.id as admin_id')
        ->join('admins','admins.id','=','letter_sends.send_by')
        ->where('letter_sends.letter_id','=',decrypt($id))->get();
        return view('department.office.meetingdecisioncreateview',$data);
    }
    // public function meetingdecisionAdd(Request $request,$letter_id){
    //     $data_mins = [
    //         ''
    //     ]
    // }



    public function complainsList(){
        return view('department.office.complainsList');
    }
   
    public function noticeWritingView(){
        return view('department.office.noticeWritingView');
    }
    
    // Reference Letter
    public function referenceLetterList(){
        $auth = Auth::user();
        $referenceLetter = ReferenceLetter::where('dept_name' ,'=',$auth->dept)->orderByDesc('id')->get();
        $data['p_referenceLetter'] = $referenceLetter->where('status','=',0);
        $data['a_referenceLetter'] = $referenceLetter->where('status','=',1);              
        return view('department.office.reference_letter_list',$data);
    }
    public function referenceLetterDetails($id){
        $reference = ReferenceLetter::where('id','=',decrypt($id))->first();
        $data['reference_letter'] = $reference;
        $data['dept'] = Department::where('department','=',$reference->dept_name)->first();
        $data['dept_chairman'] = Chairman::where('department','=',$reference->dept_name)->orderByDesc('id')->first();
        $data['info'] = DeptInfo::where('dept_name','=',$reference->dept_name)->first();
        $data['student'] =  Student::where('student_id','=',$reference->std_id)->first();;
        return view('department.letter_layouts.reference_letter_details',$data);
    }
    public function referenceLetterAccepted($id){
        $update = ReferenceLetter::where('id','=',decrypt($id))->update(['status'=> 1]);
        if($update){
            return redirect()->back()->with(['success' => __('Reference Letter Accepted')]);
        }else{
            return redirect()->back()->with(['error'=>_('Something went wrong')]);
        }
    }



    // office Info
    public function officeInFoView(){
        $auth = Auth::user();
        $info = DeptInfo::where('dept_name','=',$auth->dept)->first();
        $data['info'] = $info;
        return view('department.office.infoView',$data);
    }
    public function officeInFoAdd(Request $request){
        $auth = Auth::user();
        $info = DeptInfo::where('dept_name','=',$auth->dept)->first();
        if($info){
            $update = $info->update([
                'dept_head' => $request->dept_head,
                'dept_headB' => $request->dept_headB,
                'dept_nameB' => $request->dept_nameB,
                'dept_nameE' => $request->dept_nameE,
                'dept_head_nameB' => $request->dept_head_nameB,
                'dept_head_nameE' => $request->dept_head_nameE,
            ]);
            if($update){
                return redirect()->back()->with(['success' => __('Department info changed successfully')]);
            }else{
                return redirect()->back()->with(['error'=>_('Something went wrong')]);
            }
        }
        else{
            $dept_info = new DeptInfo();
            $auth = Auth::user();
            $request->validate([
                'dept_head'=>'required',
                'dept_nameB'=>'required',
                'dept_nameE'=>'required',
                'dept_head_nameB'=>'required',
                'dept_head_nameE'=>'required',
                'dept_head_signature'=>'required',
                'dept_headB'=>'required',
            ]);
            $dept_info->dept_head = $request->dept_head;
            $dept_info->dept_headB = $request->dept_headB;
            $dept_info->dept_nameB = $request->dept_nameB;
            $dept_info->dept_nameE = $request->dept_nameE;
            $dept_info->dept_head_nameB = $request->dept_head_nameB;
            $dept_info->dept_head_nameE = $request->dept_head_nameE;
            $dept_info->dept_name =$auth->dept;
            if ($request->file('dept_head_signature')){
                $image = $request->file('dept_head_signature');
                $image_path = $auth->dept.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/dept/signature'),$image_path);
                $dept_info->dept_head_signature = $image_path;
                
            }
        }
        $data = $dept_info->save();
        if($data){
            return redirect()->back();
        }else{
            return view('department.office.allLetter');
        }
        
    }
    public function letterView(){
        return view('department.letter_layouts.letter');
    }

    //Testimonial
    public function testimonialList(){
        $auth = Auth::user();
        $testimonials = Testimonial::where('dept_name' ,'=',$auth->dept)->orderByDesc('id')->get();
        $data['t_pending'] = $testimonials->where('status','=',0);
        $data['t_accepted'] = $testimonials->where('status','=',1);
        return view('department.office.testimonial',$data);
    }
    public function testimonialDetails($id){
        $testimonial = Testimonial::where('id','=',decrypt($id))->first();
        // $info = DeptInfo::where('dept_name','=',$testimonial->dept_name)->first();
        $dept = Department::where('department','=',$testimonial->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$testimonial->dept_name)->orderByDesc('id')->first();
        if($dept_chairman && $dept){
            $data['student'] = Student::where('student_id','=',$testimonial->std_id)->first();
            // $data['info'] = $info;
            $data['testimonial'] = $testimonial;
            $data['dept'] = $dept;
            $data['dept_chairman'] = $dept_chairman;
            return view('department.letter_layouts.testimonial',$data);
        }else{
            return redirect()->back()->with('warning','Please add department information');
        }
    }
    public function testimonialAccepted($id){
        $testimonial = Testimonial::where('id','=',decrypt($id))->first();
        $dept = Department::where('department','=',$testimonial->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$testimonial->dept_name)->orderByDesc('id')->first();
        if($dept_chairman && $dept){
            $update = Testimonial::where('id','=',decrypt($id))->update(['status'=> 1]);
            if($update){
                return redirect()->back()->with(['success' => __('Testimonial Accepted')]);
            }else{
                return redirect()->back()->with(['err'=>_('Something went wrong')]);
            }
        }else{
            return redirect()->back()->with('warning','Please add department information'); 
        }
    }
    //Instruction Certificate
    public function InstructionCertificateList(){
        $auth = Auth::user();
        $certificate = MediumCertificate::where('dept_name','=',$auth->dept)->orderByDesc('id')->get();
        $data['p_certificate'] = $certificate->where('status','=',0);
        $data['a_certificate'] = $certificate->where('status','=',1);
        return view('department.office.instruction_certificate',$data);
    }

    public function instructionCertificateDetails($id){
        $certificate = MediumCertificate::where('id','=',decrypt($id))->first();
        $dept = Department::where('department','=',$certificate->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$certificate->dept_name)->orderByDesc('id')->first();
        if($dept && $dept_chairman){
            $data['student'] = Student::where('student_id','=',$certificate->std_id)->first();
            $data['dept'] = $dept;
            $data['dept_chairman'] = $dept_chairman;
            $data['certificate'] = $certificate;
            return view('department.letter_layouts.medium_certificate',$data);
        }else{
            return redirect()->back()->with('warning','Please add department information');
        }
        
        
    }
    public function instructionCertificateAccepted($id){
        // $testimonial = Testimonial::where('id','=',$id)->first();
        $update = MediumCertificate::where('id','=',decrypt($id))->update(['status'=> 1]);
        if($update){
            return redirect()->back()->with(['success' => __('Medium Certificate Accepted')]);
        }else{
            return redirect()->back()->with(['error'=>_('Something went wrong')]);
        }
    }

    // student work
    public function studentgetProgramm($class_name){
        $auth  = Auth::user();
        $dept = Department::where('department','=',$auth->dept)->first();
        $program = Degree::where('faculty','=',$dept->faculty)->where('class_level','=',$class_name)->get();
        return response()->json($program);
    }
    public function myCertificate(){
        $auth = Auth::user();
        $certificate = MediumCertificate::where('dept_name','=',$auth->dept)->where('std_id','=',$auth->student_id)->orderByDesc('id')->get();
        $data['p_certificate'] = $certificate->where('status','=',0);
        $data['a_certificate'] = $certificate->where('status','=',1);
        return view('department.student.certificate',$data);
    }
    public function certificateCreateView(){
        $auth= Auth::user();
        $dept_faculty = Department::where('department','=',$auth->dept)->first();
        $data['districts'] = District::get();
        $data['auth'] =$auth;
        $data['degree'] = Degree::where('faculty','=',$dept_faculty->faculty)->get();
        return view('department.student.create_certificate',$data);
    }
    public function certificatePost(Request $request){
        $auth = Auth::user();
        $request->validate([
            'student_type'=>'required',
            'class_name'=>'required',
            'fprogram'=>'required',
            'full_name'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'vill_area'=>'required',
            'district'=>'required',
            'thana'=>'required',
            'post_office'=>'required',
            'academic_session'=>'required'
        ]);
        $degree = Degree::where('id','=',$request->fprogram)->first();
        $district = District::where('id','=',$request->district)->first();
        $upazila = Upazila::where('id','=',$request->thana)->first();
        $union = Union::where('id','=',$request->post_office)->first();
        $mCertificate = new MediumCertificate();
        $mCertificate->student_type =intval($request->student_type);
        $mCertificate->class_name =$request->class_name;
        $mCertificate->fprogram =$degree->degree_name;
        $mCertificate->cprogram =$degree->degree_full_name;
        $mCertificate->full_name =$request->full_name;
        $mCertificate->father_name =$request->father_name;
        $mCertificate->mother_name =$request->mother_name;
        $mCertificate->vill_area =$request->vill_area;
        $mCertificate->district =$district->name;
        $mCertificate->thana =$upazila->name;
        $mCertificate->post_office =$union->name;
        $mCertificate->academic_session =$request->academic_session;
        $mCertificate->std_id =$auth->student_id;
        $mCertificate->gender =$auth->gender;
        $mCertificate->dept_name =strtolower($auth->dept);
        $mCertificate->status =0;
        $result = $mCertificate->save();
        if($result){
            return redirect()->route('student.certificate');
        }else{
            return redirect()->back();
        }
        
    }
    //-----------search upazilla-----------
    public function upazillaSearch($district_id){
        $data['upazilas'] = Upazila::where('district_id','=',$district_id)->get();
        return view('search.upazila_search_list',$data);
    }
    //-----------search Union-----------
    public function postOfficeList($upazila_id){
        $data['unions'] = Union::where('upazila_id','=',$upazila_id)->get();
        return view('search.post_office_search_list',$data);

    }
    //----------------- start Testimonal ----------------------
    public function myTestmonial(){
        $auth = Auth::user();
        $testimonials = Testimonial::where('dept_name','=',$auth->dept)->where('std_id' ,'=',$auth->student_id)->orderByDesc('id')->get();
        $data['t_pending'] = $testimonials->where('status','=',0);
        $data['t_accepted'] = $testimonials->where('status','=',1);
        return view('department.student.testmonial',$data);
    }
    public function createTestmonialView(){
        $auth = Auth::user();
        $dept_faculty = Department::where('department','=',$auth->dept)->first();
        $data['districts'] = District::get();
        $data['auth'] =$auth;
        $data['degree'] = Degree::where('faculty','=',$dept_faculty->faculty)->get();
        return view('department.student.create_testmonial',$data);
    }
    public function testmonialPost(Request $request){
        $auth = Auth::user();
        $request->validate([
            'student_type'=>'required',
            'class_name'=>'required',
            'fprogram'=>'required',
            'full_name'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'vill_area'=>'required',
            'district'=>'required',
            'thana'=>'required',
            'post_office'=>'required',
            'ssc_gpa'=>'required',
            'hsc_gpa'=>'required'
        ]);
        $degree = Degree::where('id','=',$request->fprogram)->first();
        $district = District::where('id','=',$request->district)->first();
        $upazila = Upazila::where('id','=',$request->thana)->first();
        $union = Union::where('id','=',$request->post_office)->first();
        $testmonial = new Testimonial();
        $testmonial->student_type =intval($request->student_type);
        $testmonial->class_name =$request->class_name;
        $testmonial->complete_cgpa = $request->degree_cgpa;
        $testmonial->fprogram =$degree->degree_name;
        $testmonial->cprogram =$degree->degree_full_name;
        $testmonial->full_name =$request->full_name;
        $testmonial->father_name =$request->father_name;
        $testmonial->mother_name =$request->mother_name;
        $testmonial->vill_area =$request->vill_area;
        $testmonial->district =$district->name;
        $testmonial->thana =$upazila->name;
        $testmonial->post_office =$union->name;
        $testmonial->std_id =$auth->student_id;
        $testmonial->gender =$auth->gender;
        $testmonial->dept_name =strtolower($auth->dept);
        $testmonial->ssc_gpa =$request->ssc_gpa;
        $testmonial->hsc_gpa =$request->hsc_gpa;
        $testmonial->status =0;
        $result = $testmonial->save();
        if($result){
            return redirect()->route('student.testmonial')->with('success','your testimonail create successfully');
        }else{
            return redirect()->back()->with('err','something wrong');
        }
        
    }

    public function studentTestimonialView($id){
        $auth = Auth::user();
        $testimonial = Testimonial::where('id','=',decrypt($id))->first();
        $data['student'] = $auth;
        $dept = Department::where('department','=',$testimonial->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$testimonial->dept_name)->orderByDesc('id')->first();
        //$data['info'] = DeptInfo::where('dept_name','=',$testimonial->dept_name)->first();
        $data['testimonial'] = $testimonial;
        $data['dept'] = $dept;
        $data['dept_chairman'] = $dept_chairman;
        $pdf = PDF::loadView('department.student.service.testimonial',$data);
        return $pdf->stream();
        // return view('department.student.service.testimonial',$data);
    }
    //------------------ end Testimonal -----------------------
    public function studentMediumCertificateView($id){
        $certificate = MediumCertificate::where('id','=',decrypt($id))->first();
        $dept = Department::where('department','=',$certificate->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$certificate->dept_name)->orderByDesc('id')->first();
        $data['student'] = Auth::user();
        $data['certificate'] = $certificate;
        $data['dept'] = $dept;
        $data['dept_chairman'] = $dept_chairman;
        $pdf = PDF::loadView('department.student.service.medium_certificate',$data);
        return $pdf->stream();
        // return view('department.student.service.medium_certificate');
    }

    // student Reference Letter
    public function studentReferenceLetterList(){
        $auth = Auth::user();
        $data['p_referenceLetter'] = ReferenceLetter::where('dept_name','=',$auth->dept)->where('status','=',0)->where('std_id','=',$auth->student_id)->orderByDesc('id')->get();
        $data['a_referenceLetter'] = ReferenceLetter::where('dept_name','=',$auth->dept)->where('status','=',1)->where('std_id','=',$auth->student_id)->orderByDesc('id')->get();
        return view('department.student.reference_letter_list',$data);
    }
    public function studentReferenceLetterCreateView(){
        $auth = Auth::user();
        $dept_faculty = Department::where('department','=',$auth->dept)->first();
        $data['districts'] = District::get();
        $data['auth'] =$auth;
        $data['degree'] = Degree::where('faculty','=',$dept_faculty->faculty)->get();
        return view('department.student.reference_letter_create_view',$data);
    }
    public function studentReferenceLetterAdd(Request $request){
        $auth = Auth::user();
        $request->validate([
            'letterOpportunity'=>'required',
            'receiverTitle'=>'required',
            'organizationName'=>'required',
            'organizationAddress'=>'required',
            'student_type'=>'required',
            'class_name'=>'required',
            'country'=>'required',
            'fprogram'=>'required',
            'full_name'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'vill_area'=>'required',
            'district'=>'required',
            'thana'=>'required',
            'gender'=>'required',
            'post_office'=>'required',
            'ssc_gpa'=>'required',
            'hsc_gpa'=>'required'
        ]);
        $degree = Degree::where('id','=',$request->fprogram)->first();
        $district = District::where('id','=',$request->district)->first();
        $upazila = Upazila::where('id','=',$request->thana)->first();
        $union = Union::where('id','=',$request->post_office)->first();
        $referenceLetter = new ReferenceLetter();
        $referenceLetter->student_type =intval($request->student_type);
        $referenceLetter->class_name =$request->class_name;
        $referenceLetter->fprogram =$degree->degree_name;
        $referenceLetter->cprogram =$degree->degree_full_name;
        $referenceLetter->full_name =$request->full_name;
        $referenceLetter->father_name =$request->father_name;
        $referenceLetter->mother_name =$request->mother_name;
        $referenceLetter->vill_area =$request->vill_area;
        $referenceLetter->district =$district->name;
        $referenceLetter->thana =$upazila->name;
        $referenceLetter->gender =$request->gender;
        $referenceLetter->post_office =$union->name;
        $referenceLetter->std_id =$auth->student_id;
        $referenceLetter->country =$request->country;
        $referenceLetter->letter_opportunity =$request->letterOpportunity;
        $referenceLetter->receiver_title =$request->receiverTitle;
        $referenceLetter->organization_name =$request->organizationName;
        $referenceLetter->organization_address =$request->organizationAddress;
        $referenceLetter->std_id =$auth->student_id;
        $referenceLetter->dept_name =strtolower($auth->dept);
        $referenceLetter->ssc_gpa =$request->ssc_gpa;
        $referenceLetter->hsc_gpa =$request->hsc_gpa;
        $referenceLetter->status =0;
        $result = $referenceLetter->save();
        if($result){
            return redirect()->route('student.studentReferenceLetterList')->with(['success'=>'Your reference letter created']);
        }else{
            return redirect()->back()->with(['error'=>'Your reference letter something wrong']);
        }
    }
    public function studentReferenceLetterView($id){
        $auth = Auth::user();
        $reference_letter   = ReferenceLetter::Where('id','=',decrypt($id))->first();
        $data['reference_letter'] = $reference_letter;
        $data['info'] = DeptInfo::where('dept_name','=',$auth->dept)->first();
        $dept = Department::where('department','=',$reference_letter->dept_name)->first();
        $dept_chairman = Chairman::where('department','=',$reference_letter->dept_name)->orderByDesc('id')->first();
        $data['dept'] =$dept;
        $data['dept_chairman'] = $dept_chairman;
        $data['student'] = $auth;
        $pdf = PDF::loadView('department.student.service.reference_letter',$data);
        return $pdf->stream();
    }

    public function studentRoutineView(){
        $auth= Auth::user();
        $student_info = Admission::where('RollNumber','=',$auth->student_id)->orderBy('id','desc')->first();
        if($student_info){
            $program = Degree::where('degree_name','=',$student_info->program)->orwhere('special_degree','=',$student_info->program)->first();
            $routine = RoutineInfo::select('routine_infos.*','class_routines.*','class_routines.id as class_routine_id','admins.*','admins.dept as teacher_dept','admins.fname as teacher_fname','admins.lname as teacher_lname','semester_courses.*','dept_rooms.*')
            ->join('class_routines','class_routines.routine_info_id','=','routine_infos.id')
            ->join('admins','admins.id','=','routine_infos.teacher_id')
            ->join('dept_rooms','dept_rooms.id','=','class_routines.class_room')
            ->join('semester_courses','semester_courses.id','=','routine_infos.course_id')
            ->where('routine_infos.session_year','=',$student_info->Session)
            ->where('routine_infos.semester','=',$student_info->Semester)
            ->where('routine_infos.class_name','=',$student_info->Class)
            ->where('routine_infos.program_id','=',$program->id)
            ->where('routine_infos.dept_name','=',$student_info->Subject)
            ->get();
            $data['sunday'] = $routine->where('routine_day','=','Sun')->sortBy('class_time');
            $data['monday'] = $routine->where('routine_day','=','Mon')->sortBy('class_time');
            $data['tuesday'] = $routine->where('routine_day','=','Tue')->sortBy('class_time');
            $data['wednesday'] = $routine->where('routine_day','=','Wed')->sortBy('class_time');
            $data['thursday'] = $routine->where('routine_day','=','Thu')->sortBy('class_time');
            $data['friday'] = $routine->where('routine_day','=','Fri')->sortBy('class_time');
            $data['saturday'] = $routine->where('routine_day','=','Sat')->sortBy('class_time');
            $data['auth'] = $auth;
        }else{
            return redirect()->back()->with('warning','please admission first');
        }
        return view('department.student.routineView',$data);
    }
   
    public function semesterDurationList(){
        $auth = Auth::user();
        $data['semesterDuration']  = SemesterDuration::where('dept_name','=',$auth->dept)->orderBy('semester_year','desc')->get();
        return view('department.office.semester_duration_list',$data);
    }
    public function semesterDurationCreateView(){
        return view('department.office.semester_duration_create_view');
    }
    public function semesterDurationCreate(Request $request){
        $required = $request->validate([
            'year' => 'required',
            'semester_start' =>'required',
            'semester_end' => 'required'
        ]);
        $auth = Auth::user();

        if($required){
            $check = SemesterDuration::where('dept_name','=',$auth->dept)
            ->where('semester_year','=',$request->year)
            ->where('semester_start_date','=',$request->semester_start)
            ->where('semester_end_date','=',$request->semester_end)
            ->first();
            if(!$check){
                $data = new SemesterDuration();
                $data->dept_name = $auth->dept;
                $data->semester_year = $request->year;
                $data->semester_start_date = $request->semester_start;
                $data->semester_end_date = $request->semester_end;
                $result = $data->save();
                if($result){
                    return redirect()->route('office.semesterDurationList')->with('success','Create successfully');
                }
            }else{
                return redirect()->back()->with('warning','Already create ');
            }
            
        }else{
            return redirect()->back()->with('warning','please fill all option');
        }
    }
    public function semesterDurationUpdate(Request $request,$duration_id){
        $semester_year = $request->semester_year;
        $start_date = $request->semester_start_date;
        $end_date = $request->semester_end_date;
        if(empty($semester_year)and empty($start_date) and empty($end_date)){
            $duration_delete = SemesterDuration::where('id','=',$duration_id)->delete();
            if($duration_delete){
                return redirect()->route('office.semesterDurationList')->with('success','Delete successfully');
            }
        }else{
            $data = SemesterDuration::where('id','=',$duration_id)->update(['semester_year'=>$semester_year,'semester_start_date'=>$start_date,'semester_end_date'=>$end_date]);
            if($data){
                return redirect()->route('office.semesterDurationList')->with('warning','update successfully');
            }else{
                return redirect()->route('office.semesterDurationList')->with('err','Delete successfully');
            }
        }
    }
}
