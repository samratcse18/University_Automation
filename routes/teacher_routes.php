<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherController;

Route::get('/teacher/class-schedule',[TeacherController::class,'teacherRoutineView'])->name('teacher.teacherRoutineView');
Route::get('/teacher/class-attendance',[TeacherController::class,'studentAttendanceView'])->name('teacher.studentAttendanceView');
Route::get('/teacher/attendance-students-{dept_name}-{course}',[TeacherController::class,'deptstudentGet'])->name('deptstudentGet');
Route::get('/teacher/attendance-{dept_name}-{course_id}',[TeacherController::class,'studentClassAttendanceView'])->name('studentClassAttendanceView');
Route::post('/teacher/attendance-posts',[TeacherController::class,'studentAttendancePost'])->name('studentAttendancePost');
Route::get('/teacher/student-attendance-sheet/{course_id}',[TeacherController::class,'studentAttendanceSheet'])->name('studentAttendanceSheet');
Route::get('/teacher/assignment',[TeacherController::class,'courseAssignmentList'])->name('teacher.courseAssigmentList');
Route::get('/teacher/assignment-create-{course_id}',[TeacherController::class,'courseAssignmentCreateView'])->name('teacher.courseAssignmentCreateView');
Route::post('/teacher/assignment-create',[TeacherController::class,'courseAssignmentCreate'])->name('teacher.courseAssignmentCreate');
Route::get('/teacher/take-leave-application-list',[TeacherController::class,'takeLeaveApplicationList'])->name('teacher.takeLeaveApplicationList');
Route::post('/teacher/take-leave-application-create',[TeacherController::class,'takeLeaveApplicationCreate'])->name('teacher.takeLeaveApplicationCreate');
Route::get('/teacher/take-leave-application-create-view',[TeacherController::class,'takeLeaveApplicationCreateView'])->name('teacher.takeLeaveApplicationCreateView');
Route::get('/teacher/take-leave-application-details-{application_id}',[TeacherController::class,'takeLeaveApplicationDetails'])->name('teacher.takeLeaveApplicationDetails');
// chairman
Route::get('/home/chairman/staff-take-leave-applications',[TeacherController::class,'teacherleaveApplicationlistShowchairman'])->name('chairman.stafftakeleaveappliaction');
Route::get('/home/chairman/staff-{application_id}-take-leave-applications-approve-view',[TeacherController::class,'chairmanApproveLeaveApplicationView'])->name('chairman.chairmanApproveLeaveApplicationView');
Route::post('/home/chairman/staff-application-approve',[TeacherController::class,'leaveApplicationApprove'])->name('chairman.leaveApplicationApprove');