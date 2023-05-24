<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;


Route::get('/student', [StudentController::class, 'Home'])->name('user.student');
    Route::get('/student/admission', [StudentController::class, 'admission'])->name('student.admission');
    Route::get('/student/profile', [StudentController::class, 'studentProfile'])->name('student.studentProfile');
    Route::post('/student/profile/create', [StudentController::class, 'updateProfile'])->name('student.updateProfile');
    Route::post('/student/admission/level', [StudentController::class, 'admissionLevel'])->name('student.admissionLevel');
    Route::get('/student/form/{id}', [StudentController::class, 'step']);
    Route::post('/student/admission/pay_slip_view', [StudentController::class, 'admissionData'])->name('student.admissionData');
    Route::get('/student_logout', [StudentController::class, 'logout'])->name('student.logout');
    Route::view('/student/assignment', 'file_submission')->name('student.assignment');
    Route::post('/student/dataSend', [StudentController::class, 'upload'])->name('student.file');
    Route::view('/student/application', 'ApplicationHome')->name('student.application');
    Route::post('/student/application/submit', [StudentController::class, 'applicationData'])->name('student.applicationData');
    Route::get('student/exam_registration', [StudentController::class,'ExamRegistration'])->name('student.ExamRegistration');
    Route::get('student/exam_registration/data', [StudentController::class,'examRegistrationData'])->name('student.examRegistrationData');
    Route::post('student/program_type', [StudentController::class,'program_type'])->name('student.program_type');
    Route::post('student/course', [StudentController::class,'course'])->name('student.course');
    Route::get('student/examPdf', [StudentController::class,'examPdf'])->name('student.examPdf');
    Route::get('/export_pdf', [StudentController::class, 'pdf'])->name('student.pdf');
    Route::get('/apply_hall', [StudentController::class, 'applyHall'])->name('student.applyHall');
    Route::post('/apply_hall/add', [StudentController::class, 'sendApplyHallData'])->name('student.sendApplyHallData');
    Route::get('/hallPayslip', [StudentController::class, 'hallPayslip'])->name('student.hallPayslip');
    Route::get('/billingSlip/{M}', [StudentController::class, 'billingSlip'])->name('student.billingSlip');
    Route::get('/student/circularView', [StudentController::class, 'circularView'])->name('student.circularView');
    Route::view('/student/view_notices', 'viewNotices')->name('student.view_notices');

