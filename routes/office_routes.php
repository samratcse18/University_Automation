<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\OfficeController;
//dept room
Route::get('/dept-room-list',[OfficeController::class,'roomList'])->name('dept.roomlist');
Route::get('/dept-room-create-view',[OfficeController::class,'roomCreateView'])->name('roomCreateView');
Route::post('/dept-room-create-save',[OfficeController::class,'roomCreateSave'])->name('roomCreateSave');
// Routine
Route::post('/present-year-semester',[OfficeController::class,'presentYearSemester'])->name('present_year_semester');
Route::get('regular-session-get',[OfficeController::class,'regularSessionGet'])->name('office.regularSessionGet');
Route::get('/dept-{year}-{semester}-{session}',[OfficeController::class,'getCourse'])->name('getCourse');
Route::get('/room-list',[OfficeController::class,'selectRoomList'])->name('selectRoomList');
Route::get('/select-teacher-{dept_name}',[OfficeController::class,'getCallDeptTeacher'])->name('selectTeacher');
Route::get('/select-dept-teacher',[OfficeController::class,'interTeacher'])->name('interTeacher');
Route::get('/routine', [OfficeController::class ,'officeRoutineList'])->name('admin.routine');
Route::get('/office/routine-create', [OfficeController::class ,'routineCreateView'])->name('office.routineCreateView');
Route::post('/office/routine-create-save',[OfficeController::class,'routineCreateSave'])->name('office.routineCreateSave');
Route::get('/routine-{class_routine_id}/update-view',[OfficeController::class,'routineClassUpdateView'])->name('office.routineClassUpdateView');
// letter
Route::get('all-letters',[OfficeController::class ,'allLetters'])->name('office.letters');
Route::get('/letter-writing', [OfficeController::class ,'leterWritingView'])->name('office.letterWriting');
Route::get('/select-{dept_name}-teacher',[OfficeController::class,'letterDeptTeacher'])->name('letterDeptTeacher');
Route::post('/create-new-letter',[OfficeController::class ,'createLetter'])->name('office.createLetter');
Route::get('/letter-send-members/{id}',[OfficeController::class ,'letterSendByMembers'])->name('office.letterSendByMembers');
Route::post('/letter-add-new-member',[OfficeController::class,'letterAddNewMembers'])->name('office.letterAddNewMembers');
Route::get('/letter-{id}-view',[OfficeController::class,'singleLetterView'])->name('office.singleLetterView');
// meeting decision
Route::get('/meeting-mins', [OfficeController::class ,'meetingMinsView'])->name('admin.meetingmins');
Route::get('/meeting-desicion-{id}-create', [OfficeController::class ,'meetingdecisionCreateView'])->name('office.meetingdecisionCreateView');
Route::post('/meeting-desicion-{letter_id}-add', [OfficeController::class ,'meetingdecisionAdd'])->name('office.meetingdecisionAdd');


Route::get('/all-complains', [OfficeController::class ,'complainsList'])->name('admin.complainsList');
Route::get('/all-notices', [OfficeController::class ,'noticeWritingView'])->name('admin.noticeWritingView');
Route::get('/office-information', [OfficeController::class ,'officeInFoView'])->name('office.officeInFoView');
Route::post('/office-information-add', [OfficeController::class ,'officeInFoAdd'])->name('office.officeInFoAdd');
//Testimonial
Route::get('/testimonial-list',[OfficeController::class,'testimonialList'])->name('office.testimonialList');
Route::get('/testimonial-{id}-details',[OfficeController::class,'testimonialDetails'])->name('office.testimonialDetails');
Route::post('/testimonial-{id}-update',[OfficeController::class,'testimonialAccepted'])->name('office.testimonialAccepted');

//Medium of Instruction Certificate
Route::get('/instruction-certificate-list',[OfficeController::class,'InstructionCertificateList'])->name('office.InstructionCertificateList');
Route::get('/instruction-certificate-{id}-details',[OfficeController::class,'instructionCertificateDetails'])->name('office.instructionCertificateDetails');
Route::post('/instruction-certificate-{id}-update',[OfficeController::class,'instructionCertificateAccepted'])->name('office.instructionCertificateAccepted');
//Reference Letter
Route::get('/reference-letter-list',[OfficeController::class,'referenceLetterList'])->name('office.referenceLetterList');
Route::get('/reference-letter-{id}-details',[OfficeController::class,'referenceLetterDetails'])->name('office.referenceLetterDetails');
Route::post('/reference-letter-{id}-update',[OfficeController::class,'referenceLetterAccepted'])->name('office.referenceLetterAccepted');
// Template
Route::get('/letter-view',[OfficeController::class,'letterView'])->name('office.letterView');
//course section
Route::get('/dept-course',[OfficeController::class,'deptCourse'])->name('dept_course');
Route::get('/course-create',[OfficeController::class,'courseCreateView'])->name('courseCreateView');
Route::post('/course-create-save',[OfficeController::class,'courseCreateSave'])->name('courseCreateSave');
Route::get('/program-type-session-{program_type}',[OfficeController::class,'programTypeSession'])->name('office.programTypeSession');
Route::get('/class-name-to-program-{class_name}',[OfficeController::class,'ClassNameToProgram'])->name('office.ClassNameToProgram');
Route::get('/{student_type}/{batch_session}/{class_name}/{semester}',[OfficeController::class,'classNameToProgramCourseCode'])->name('office.classNameToProgramCourseCode');
Route::post('/dept-course/update-{course_id}',[OfficeController::class,'courseUpdate'])->name('dept.courseUpdate');
// Syllabus
Route::get('/syllabus-list',[OfficeController::class,'deptSyllabusList'])->name('dept.deptSyllabusList');
Route::get('/syllabus-create',[OfficeController::class,'deptSyllabusCreateView'])->name('dept.deptSyllabusCreateView');
Route::post('/add-new-syllabus',[OfficeController::class,'deptSyllabusCreate'])->name('dept.syllabusAdd');
Route::get('/syllabus-download-{file_path}',[OfficeController::class,'syllabusShow'])->name('dept.syllabusShow');
//semester_duration
Route::get('/semester-duration-list',[OfficeController::class,'semesterDurationList'])->name('office.semesterDurationList');
Route::get('/semester-duration-create-view',[OfficeController::class,'semesterDurationCreateView'])->name('office.semesterDurationCreateView');
Route::post('/semester-duration-create',[OfficeController::class,'semesterDurationCreate'])->name('office.semesterDurationCreate');
Route::post('//semester-duration-update-{duration_id}',[OfficeController::class,'semesterDurationUpdate'])->name('office.semesterDurationUpdate');

