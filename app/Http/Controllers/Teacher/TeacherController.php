<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoutine;
use App\Models\Student;
use App\Models\Admin;
use App\Models\RoutineInfo;
use App\Models\SemesterCourse;
use App\Models\StudentAttendance;
use App\Models\CourseAssignment;
use App\Models\VacationApplication;
use App\Models\SemesterDuration;
use Auth;
use DB;
use PDF;
class TeacherController extends Controller
{
    
    public function teacherRoutineView(){
        $auth = Auth::user();
        $date = date('Y-m-d');
        $routine = RoutineInfo::select('class_routines.*','routine_infos.*','dept_rooms.*','semester_courses.*','semester_courses.semester as semester_number','semester_courses.id as course_id')
                    ->join('class_routines','class_routines.routine_info_id','=','routine_infos.id')
                    ->join('dept_rooms','dept_rooms.id','=','class_routines.class_room')
                    ->join('semester_courses','semester_courses.id','=','routine_infos.course_id')
                    ->join('semester_durations','semester_durations.id','=','routine_infos.semester_duration_id')
                    ->where('routine_infos.teacher_id','=',$auth->id)
                    ->whereDate('semester_durations.semester_start_date','<=',$date)
                    ->whereDate('semester_durations.semester_end_date','>=',$date)
                    ->get();
        $data['sunday'] = $routine->where('routine_day','=','Sun')->sortBy('class_time');
        $data['monday'] = $routine->where('routine_day','=','Mon')->sortBy('class_time');
        $data['tuesday'] = $routine->where('routine_day','=','Tue')->sortBy('class_time');
        $data['wednesday'] = $routine->where('routine_day','=','Wed')->sortBy('class_time');
        $data['thursday'] = $routine->where('routine_day','=','Thu')->sortBy('class_time');
        $data['friday'] = $routine->where('routine_day','=','Fri')->sortBy('class_time');
        $data['saturday'] = $routine->where('routine_day','=','Sat')->sortBy('class_time');
        return view('department.teacher.routineView',$data);
    }

    public function studentAttendanceView(){
        $auth = Auth::user();
        $data['routine_info'] = RoutineInfo::select('routine_infos.course_id as course_id','semester_courses.course_code as course_code')
                ->join('semester_courses','semester_courses.id','=','routine_infos.course_id')
                ->where('teacher_id','=',$auth->id)->get();
        return view('department.teacher.all_attendance',$data);
    }
    public function studentClassAttendanceView($dept_name,$course_id){
        $auth = Auth::user();
        $course = SemesterCourse::where('course_code','=',$course_id)->first();
        $today_attendance = StudentAttendance::where('dept_name','=',$dept_name)
                                    ->where('course_id','=',$course->id)
                                    ->whereDate('created_at','=',date('Y-m-d'))
                                    ->where('teacher_id','=',$auth->id)->get();
        $data['today_attendance'] = count($today_attendance);                            
        $data['dept_name'] = $dept_name;
        $data['course_id'] = $course_id;
        return view('department.teacher.attendance',$data);

    }
    public function studentAttendancePost(Request $request){
        $auth = Auth::user();
        $dept = $request->dept_name;
        $course =SemesterCourse::where('course_code','=',$request->course_code)->first();
        $students = $request->attendances;
        $student_length =count($students);
        if($student_length>0){
            for($id=0;$id < $student_length;$id++){
                StudentAttendance::create([
                    'student_id' =>$students[$id]['std_id'],
                    'dept_name' =>$dept,
                    'attendance_status' =>$students[$id]['attendance'],
                    'course_id' =>$course->id,
                    'teacher_id'=>$auth->id

                ]);
            }
            return response()->json('success');
        }else{
            return response()->json('error');
        }
    }
    public function deptstudentGet($dept_name,$course){
        $course_session = SemesterCourse::where('course_code','=',$course)->first();
        $student = Student::where('dept','=',$dept_name)->where('session','=',$course_session->session_year)->orderBy('student_id','asc')->get();
        return response()->json($student);
    }
    public function studentAttendanceSheet($course_id){
        $auth= Auth::user();
        $student_ids =  StudentAttendance::select('student_id')->where('course_id','=',$course_id)->where('teacher_id','=',$auth->id)->orderBy('student_id', 'asc')->groupBy('student_id')->get();
        $class_date = StudentAttendance::select(DB::raw("(DATE_FORMAT(created_at, '%Y-%m-%d')) as create_at"))
                    ->where('course_id','=',$course_id)
                    ->where('teacher_id','=',$auth->id)
                    ->groupBy('created_at')
                    ->orderBy('created_at', 'asc')
                    
                    ->get();
        $data['student_ids'] = $student_ids;
        $single_student =  array();
        foreach($student_ids as $student_id){
                $student =StudentAttendance::where('student_id','=',$student_id->student_id)->orderBy('created_at', 'asc')->get();
                array_push($single_student,$student);
        }
        $data['course'] =SemesterCourse::where('id','=',$course_id)->first();
        $data['class_dates'] = $class_date;
        $data['attendance_sheet'] =$single_student;
        return view('department.teacher.attendance_sheet',$data);

    }
    public function courseAssignmentList(){
        $auth = Auth::user();
        $data['assignments'] = CourseAssignment::select('course_assignments.assignment_title as assignment_title','course_assignments.submit_last_date as submit_last_date','semester_courses.course_code as course_code')
                            ->join('semester_courses','semester_courses.id','=','course_assignments.course_id')
                            ->where('teacher_id','=',$auth->id)
                            ->orderBy('course_assignments.id','desc')->get();
        return view('department.teacher.all_assignment',$data);
    }
    public function courseAssignmentCreateView($course_id){
        $data['course_id'] = $course_id;
        return view('department.teacher.assignment',$data);
    }
    public function courseAssignmentCreate(Request $request){
        $request->validate([
            'assignment_title'=>'required',
            'submit_last_date' =>'required',
            'course_id' => 'required'
        ]);
        $auth = Auth::user();
        $data = new CourseAssignment();
        $data->course_id = intval($request->course_id);
        $data->teacher_id =$auth->id;
        $data->assignment_title = $request->assignment_title;
        $data->assignment_description = $request->assignment_description;
        $data->submit_last_date = $request->submit_last_date;
        $result = $data->save();
        if($result){
            return redirect()->route('teacher.courseAssigmentList')->with('success','Assignment create successfully');
        }else{
            return redirect()->route('teacher.courseAssigmentList')->with('err','Some thing worng');
        }
        
    }
    public function takeLeaveApplicationList(){
        $auth= Auth::user();
        $applications = VacationApplication::where('admin_id','=',$auth->id)->orderBy('created_at','desc')->get();
        $data['approve'] = $applications->where('application_status','=',1);
        $data['inprocess'] = $applications->where('application_status','=',0);
        return view('department.teacher.chuti_list',$data);
    }
    public function takeLeaveApplicationCreateView(){
        $auth = Auth::user();
        $data['dept_teacher'] =Admin::select('admins.*')
                                ->join('model_has_roles','model_has_roles.model_id','=','admins.id')
                                ->whereIn('model_has_roles.role_id',['13'])
                                ->where('admins.dept','=',$auth->dept)
                                ->where('admins.id','!=',$auth->id)
                                ->get();
        return view('department.teacher.chuti_create',$data);
    }
    public function takeLeaveApplicationCreate(Request $request){
        $request->validate([
            'reason_for_leave' => 'required',
            'vacation_start' => 'required',
            'vacation_end' => 'required',
            'helper_id' => 'required'
        ]);
        
        $auth = Auth::user();
        $data = new VacationApplication();
        $data->admin_id = $auth->id;
        $data->reason_title =$request->reason_for_leave ;
        $data->vacation_start =$request->vacation_start ;
        $data->vacation_end =$request->vacation_end ;
        $data->vacation_days =intval($request->vacation_days) ;
        $data->application_status = 0;
        $data->helper_id = intval($request->helper_id);
        $data->dept_name =$auth->dept ;
        $result = $data->save();
        if($result){
            return redirect()->route('teacher.takeLeaveApplicationList')->with('success','Application create successfully');
        }else{
            return redirect()->route('teacher.takeLeaveApplicationList')->with('err','some thing worng');
        }

    }
    public function takeLeaveApplicationDetails($application_id){
        $data['application'] = VacationApplication::select(
                                'admins.fname as first_name',
                                'admins.lname as last_name',
                                'admins.dept as dept_name',
                                'admins.phone as phone',
                                'vacation_applications.reason_title as reason',
                                'vacation_applications.vacation_start as vacation_start',
                                'vacation_applications.vacation_end as vacation_end',
                                'vacation_applications.vacation_end as vacation_end',
                                'vacation_applications.vacation_days as vacation_days',
                                'helper_admin.fname as helper_first_name',
                                'helper_admin.lname as helper_last_name'
                            )
                            ->join('admins','admins.id','=','vacation_applications.admin_id')
                            ->join('admins as helper_admin','helper_admin.id','=','vacation_applications.helper_id')
                            ->where('vacation_applications.id','=',$application_id)->first();
        // return view('department.leave_application',$data);
        $pdf = PDF::loadView('department.leave_application',$data);
        return $pdf->stream();
    }

    public function teacherleaveApplicationlistShowchairman(){
        $auth = Auth::user();
        $data['applications'] = VacationApplication::select('vacation_applications.id as vacation_id',
        'admins.fname as first_name',
        'admins.lname as last_name',
        'vacation_applications.application_status as status',
        'vacation_applications.reason_title as reason'
        )
                                ->join('admins','admins.id','=','vacation_applications.admin_id')
                                ->where('vacation_applications.dept_name','=',$auth->dept)->orderBy('vacation_applications.id','desc')->get();
        return view('department.chairman.staff_leave_application_list',$data);
    }
    public function chairmanApproveLeaveApplicationView($application_id){
        $data['application'] = VacationApplication::where('id','=',$application_id)->first();
        return view('department.chairman.staff_leave_application_approve_view',$data);
    }
    public function leaveApplicationApprove(Request $request){
        $application_id = $request->application_id;
        $request->validate([
            'approve_days'=>'required'
        ]);
        $data  = VacationApplication::where('id','=',$application_id)->update(['approve_days'=>$request->approve_days,'application_status'=>1]);
        if($data){
            return redirect()->route('chairman.stafftakeleaveappliaction')->with('success','Application Approve '.$request->approve_days.'Days');
        }else{
            return redirect()->back()->with('err','Application some Error');
        }
        
    }
}
