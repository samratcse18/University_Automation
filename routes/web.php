<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bank\BankController;
use App\Http\Controllers\Office\OfficeController;

Auth::routes();
Route::view('/', 'login');
Route::view('/role', 'roleHome');
Route::post('/role/add', [FeeController::class, 'index'])->name('role');
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'login1')->name('user.login');
    Route::view('/signUp', 'studentRegistration');
    Route::view('/forgot_password', 'forgotPassword')->name('forgot_password');
    Route::post('/forgotPasswordData', [LoginController::class, 'forgotPasswordData'])->name('user.forgotPasswordData');
    Route::post('/create', [StudentController::class, 'create'])->name('user.create');
    Route::post('/dologin', [LoginController::class, 'dologin'])->name('user.dologin');
    Route::get('/mail/{roll}', [StudentController::class, 'mailVerify'])->name('user.mailVerify');
    Route::get('/reset_password/{id}-{model}', [LoginController::class, 'resetPassword']);
    Route::post('/reset_password/final', [LoginController::class, 'resetPasswordData'])->name('resetPasswordData');
});
Route::middleware(['auth:student'])->group(function () {
    require base_path('routes/studentRoutes.php');
    //.................Limon Vai....................
    Route::get('/student-get-program-{class_name}',[OfficeController::class,'studentgetProgramm'])->name('student.studentgetProgramm');
    Route::get('all-certificate',[OfficeController::class,'myCertificate'])->name('student.certificate');
    Route::get('certificate-create-view',[OfficeController::class,'certificateCreateView'])->name('student.certificateCreateView');
    Route::post('certificate-create',[OfficeController::class,'certificatePost'])->name('student.certificatePost');
    Route::get('medium-certificate-{id}-View',[OfficeController::class,'studentMediumCertificateView'])->name('student.studentMediumCertificateView');
    // limon tesmonial
    Route::get('all-testmonial',[OfficeController::class,'myTestmonial'])->name('student.testmonial');
    Route::get('testmonial-create-view',[OfficeController::class,'createTestmonialView'])->name('student.createTestmonialView');
    Route::post('testmonial-create',[OfficeController::class,'testmonialPost'])->name('student.testmonialPost');
    Route::get('testimonial-{id}-view',[OfficeController::class,'studentTestimonialView'])->name('student.studentTestimonialView');
    // Reference Letter
    Route::get('/student/reference-letter-list',[OfficeController::class,'studentReferenceLetterList'])->name('student.studentReferenceLetterList');
    Route::get('/student/reference-letter-create',[OfficeController::class,'studentReferenceLetterCreateView'])->name('student.studentReferenceLetterCreateView');
    Route::post('/student/reference-letter-add',[OfficeController::class,'studentReferenceLetterAdd'])->name('student.studentReferenceLetterAdd');
    Route::get('/student/reference-letter-{id}-view',[OfficeController::class,'studentReferenceLetterView'])->name('student.studentReferenceLetterView');
    // Routine
    Route::get('/student/routine',[OfficeController::class,'studentRoutineView'])->name('student.routineView');
    //upazila search list
    Route::get('/upazila/search/{district_id}',[OfficeController::class,'upazillaSearch'])->name('upazillaSearch');
    //union search list
    Route::get('/post-office/list/{upazila_id}',[OfficeController::class,'postOfficeList'])->name('postOfficeList');

});
Route::middleware(['auth:admin'])->group(function () {
    require base_path('routes/adminRoutes.php');
    //......................Limon.........................................
    // office staff
    require base_path('routes/office_routes.php');
    //teacher route
    require base_path('routes/teacher_routes.php');
});
Route::middleware(['auth:bank'])->group(function () {
    Route::view('/bank', 'DashboardContent')->name('user.bank');
    Route::view('/bank/scan', 'bankScan')->name('bank.scan');
    Route::get('/bank/statement', [BankController::class, 'bankStatement'])->name('bank.statement');
    Route::get('/bank_logout', [BankController::class, 'logout'])->name('bank.logout');
    Route::post('/barcode', [BankController::class, 'scanBarcode'])->name('bank.barcode');
    Route::post('/getStatementData', [BankController::class, 'getStatementData'])->name('bank.getStatementData');
    Route::get('/exportExcel', [BankController::class, 'exportExcel'])->name('bank.exportExcel');
    Route::get('/bank/profile_update', [BankController::class, 'bankProfileUpdate'])->name('bank.profileUpdate');
    Route::post('/bank/profile_update/update', [BankController::class, 'bankProfileUpdateData'])->name('bank.updateProfileData');
    Route::get('/bank/office_staff', [BankController::class, 'officeStaff'])->name('bank.officeStaff');
    Route::view('/bank/office_staff/add', 'addBankOfficeStaff')->name('bank.addBankOfficeStaff');
    Route::post('/bank/office_staff/create', [BankController::class, 'bankOfficeStaffCreate'])->name('bank.bankOfficeStaffCreate');
    Route::post('/bank/office_staff/edit', [BankController::class, 'officeStaffEdit'])->name('bank.officeStaffEdit');
    Route::post('/bank/office_staff/edit/data', [BankController::class, 'bankOfficeStaffEditData'])->name('bank.bankOfficeStaffEditData');
    Route::post('/bank/office_staff/delete', [BankController::class, 'officeStaffDelete'])->name('bank.officeStaffDelete');
});
