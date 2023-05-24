@extends('layouts.Dashboard')
@section('content')
    @php
        use App\Models\Chairman;
        $user = Auth::guard('admin')->user();
        if ($user) {
            $chairman = Chairman::where('email', $user->email)->first();
        }
    @endphp
    <div
        class="content mt-2 grid grid-cols-2 justify-items-center gap-[25px] pb-[16px] md:grid-cols-4 lg:gap-[33px] lg:pb-0">
        @can('student.dashboard')
            <a href="{{ route('student.admission') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/stickers/100/null/admission.png" />
                <h1>Admission</h1>
            </a>
            <a href="{{ route('student.assignment') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/color-glass/96/null/send-file.png" />
                <h6>Assignment</h6>
            </a>
            <a href="{{ route('student.ExamRegistration') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-registration-form-politics-flaticons-lineal-color-flat-icons.png" />
                <h1>Exam Registration</h1>
            </a>
            @if (Auth::guard('student')->user()->dept != 'FBS')
                <a href="{{ route('student.applyHall') }}" onclick="show()"
                    class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                    <img src="https://img.icons8.com/color/96/null/corridor.png" />
                    <h1>Apply Hall</h1>
                </a>
            @endif
            <a href="{{ route('student.certificate') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/color/96/null/contract.png" />
                <h1>MOI Certificate</h1>
            </a>
            <a href="{{ route('student.testmonial') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-testimonials-web-store-flaticons-lineal-color-flat-icons.png" />
                <h1>Testmonial</h1>
            </a>
            <a href="{{ route('student.studentReferenceLetterList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/fluency/48/null/refer-to-manual.png" />
                <h1>Reference Letter</h1>
            </a>
            <a href="{{ route('student.routineView') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-routine-productivity-flaticons-lineal-color-flat-icons.png" />
                <h1>Routine</h1>
            </a>
            <a href="{{ route('student.view_notices') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>View Notices</h1>
            </a>

            @if ($data)
                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "3000",
                            "hideDuration": "1000",
                            "timeOut": 5000,
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.error('Please Update Your Profile');
                    });
                </script>
            @endif
        @endcan
        @can('admin.dashboard')
            @if ($chairman->signature == null)
                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "positionClass": "toast-top-center",
                            "timeOut": "5000",
                        }
                        toastr.error('Please Add Your Signture');
                    });
                </script>
            @endif
            <a href="{{ route('admin.view_notices') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>View Notics</h1>
            </a>
            <a href="{{ route('admin.account') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-becris-lineal-color-becris/64/null/external-bank-account-banking-becris-lineal-color-becris.png" />
                <h1>Add Account</h1>
            </a>
            <a href="{{ route('admin.fee') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-bearicons-blue-bearicons/64/null/external-Taka-currency-bearicons-blue-bearicons.png" />
                <h1>Add Fee</h1>
            </a>
            <a href="{{ route('admin.teacherHome') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-kosonicon-flat-kosonicon/64/null/external-teacher-back-to-school-kosonicon-flat-kosonicon.png" />
                <h1>Add Teacher</h1>
            </a>
            <a href="{{ route('admin.admissionReport') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/stickers/100/null/admission.png" />
                <h1>Admission Report</h1>
            </a>
            <a href="{{ route('admin.officeStaff') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/plasticine/100/null/user-group-man-man.png" />
                <h1>Office Staff</h1>
            </a>
        @endcan
        @can('dean.dashboard')
            <a href="{{ route('admin.view_notices') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>View Notics</h1>
            </a>
            <a href="{{ route('admin.department') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/plasticine/100/null/department.png" />
                <h1>Department</h1>
            </a>
            <a href="{{ route('admin.chairman') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-microdots-premium-microdot-graphic/64/null/external-ceo-business-finance-vol3-microdots-premium-microdot-graphic.png" />
                <h1>Chairman</h1>
            </a>
            <a href="{{ route('admin.degree') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-degree-online-education-flaticons-lineal-color-flat-icons.png" />
                <h1>Regular Degree</h1>
            </a>
            <a href="{{ route('admin.specialDegree') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-degree-online-education-flaticons-lineal-color-flat-icons.png" />
                <div class="text-center">Professional Degree</div>
            </a>
        @endcan
        @if (Auth::guard('bank')->user())
            <a href="{{ route('bank.scan') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-xnimrodx-lineal-gradient-xnimrodx/64/null/external-barcode-scan-delivery-xnimrodx-lineal-gradient-xnimrodx.png" />
                <div class="text-center">Scan Invoice</div>
            </a>
            <a href="{{ route('bank.statement') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <i class="fa-solid fa-file-word text-5xl"></i>
                <h1>Statement</h1>
            </a>
            @can('bank_manager.dashboard')
                <a href="{{ route('bank.officeStaff') }}"
                    class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                    <img src="https://img.icons8.com/plasticine/100/null/user-group-man-man.png" />
                    <h1>Office Staff</h1>
                </a>
            @endcan
            @php
                $data = Auth::guard('bank')->user();
            @endphp
            @if (empty($data->street) && empty($data->city) && empty($data->district))
                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "3000",
                            "hideDuration": "1000",
                            "timeOut": 5000,
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.error('Please Update Your Profile');
                    });
                </script>
            @endif
        @endif
        @if (($user && $user->hasExactRoles('superAdmin')))
            <a href="{{ route('admin.faculty') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-faculty-university-flaticons-flat-flat-icons-3.png" />
                <h1>Faculty</h1>
            </a>
            <a href="{{ route('admin.dean') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-professor-university-flaticons-flat-flat-icons.png" />
                <h1>Dean</h1>
            </a>
            <a href="{{ route('admin.hall') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-hall-interior-flaticons-flat-flat-icons.png" />
                <h1>Hall</h1>
            </a>
            <a href="{{ route('admin.provost') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-scholar-literature-flaticons-lineal-color-flat-icons-6.png" />
                <h1>Provost</h1>
            </a>
            <a href="{{ route('admin.controller') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-manager-professions-flaticons-lineal-color-flat-icons-4.png" />
                <h1>Controller</h1>
            </a>
            <a href="{{ route('admin.department') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/plasticine/100/null/department.png" />
                <h1>Department</h1>
            </a>
            <a href="{{ route('admin.session') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-session-event-management-flaticons-lineal-color-flat-icons-2.png" />
                <h1>Session Reg</h1>
            </a>
            <a href="{{ route('admin.professionalSession') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-session-event-management-flaticons-lineal-color-flat-icons-2.png" />
                <div class="text-center">Session Pro</div>
            </a>
            <a href="{{ route('admin.account') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-becris-lineal-color-becris/64/null/external-bank-account-banking-becris-lineal-color-becris.png" />
                <h1>Add Account</h1>
            </a>
            <a href="#"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-records-human-resources-flaticons-lineal-color-flat-icons.png" />
                <h1>Records</h1>
            </a>
            <a href="{{ route('admin.fee') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-bearicons-blue-bearicons/64/null/external-Taka-currency-bearicons-blue-bearicons.png" />
                <h1>Add Fee</h1>
            </a>
        @endif
        @can('provost.dashboard')
            <a href="{{ route('admin.hallStudentStatus') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/avantgarde/100/null/ok.png" />
                <h1>Add Student Status</h1>
            </a>
            <a href="{{ route('admin.hallRoom') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/plasticine/100/null/room.png" />
                <h1>Add Hall Room</h1>
            </a>
            <a href="{{ route('admin.account') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-becris-lineal-color-becris/64/null/external-bank-account-banking-becris-lineal-color-becris.png" />
                <h1>Hall Account</h1>
            </a>
            <a href="{{ route('admin.fee') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-bearicons-blue-bearicons/64/null/external-Taka-currency-bearicons-blue-bearicons.png" />
                <h1>Hall Fee</h1>
            </a>
            <a href="{{ route('admin.hallCircular') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>Hall Circular</h1>
            </a>
        @endcan
        @can('office.dashboard')
            <a href="{{ route('admin.view_notices') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>View Notics</h1>
            </a>
            <a href="{{ route('admin.admissionRoll') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/color/96/null/book-and-pencil.png" />
                <div class="text-center">Add Student Admission Roll</div>
            </a>
            <a href="{{ route('admin.routine') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-inipagistudio-lineal-color-inipagistudio/64/null/external-routine-covid-cabin-fever-inipagistudio-lineal-color-inipagistudio.png" />
                <div class="text-center">Class Routine</div>
            </a>
            <a href="{{ route('office.letters') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/fluency/96/null/appointment-scheduling.png" />
                <div class="text-center">Meeting Letter</div>
            </a>
            <a href="{{ route('admin.complainsList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/color/96/null/complaints.png" />
                <div class="text-center">Student complains</div>
            </a>
            <a href="{{ route('office.testimonialList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-filled-line-gradient-andi-nur-abdillah/64/null/external-Testimonial-survey-(filled-line)-filled-line-gradient-andi-nur-abdillah.png" />
                <div class="text-center">Testimonial</div>
            </a>
            <a href="{{ route('office.InstructionCertificateList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/color/96/null/contract.png" />
                <div class="text-center">MOI Certificate</div>
            </a>
            <a href="{{ route('office.referenceLetterList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/office/80/null/secured-letter--v1.png" />
                <div class="text-center">Reference Letter</div>
            </a>
            <a href="{{ route('dept_course') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-course-resume-flaticons-lineal-color-flat-icons.png" />
                <div class="text-center">Course</div>
            </a>
            <a href="{{ route('dept.roomlist') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/office/80/null/room.png" />
                <div class="text-center">Depertment room</div>
            </a>
            <a href="{{ route('office.semesterDurationList') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-duration-video-production-flaticons-lineal-color-flat-icons.png" />
                <div class="text-center">Semester Duration</div>
            </a>
            <a href="{{ route('admin.hallCircular') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/bubbles/50/null/news.png" />
                <h1>Notice</h1>
            </a>
            <a href="{{ route('admin.admissionReport') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img src="https://img.icons8.com/stickers/100/null/admission.png" />
                <h1>Admission Report</h1>
            </a>
            <a href="{{ route('admin.ExamRegistration') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-registration-form-politics-flaticons-lineal-color-flat-icons.png" />
                <h1>Exam Reg Report</h1>
            </a>
        @endcan
        @can('controller.dashboard')
            <a href="{{ route('admin.account') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-becris-lineal-color-becris/64/null/external-bank-account-banking-becris-lineal-color-becris.png" />
                <h1>Add Account</h1>
            </a>
            <a href="{{ route('admin.fee') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-bearicons-blue-bearicons/64/null/external-Taka-currency-bearicons-blue-bearicons.png" />
                <h1>Add Fee</h1>
            </a>
            <a href="{{ route('admin.ExamRegistration') }}"
                class="flex h-[156px] w-[156px] cursor-pointer flex-col items-center justify-center bg-[#E2E2E2] hover:bg-[#006666] hover:text-white">
                <img
                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-registration-form-politics-flaticons-lineal-color-flat-icons.png" />
                <h1>Exam Registrasion</h1>
            </a>
        @endcan
    </div>
@endsection
{{-- @section('admission_form')
    <div class="content w-full space-y-[19px]">
                <div
                    class="bg-[#3E3E3E] text-white text-[23px] font-semibold h-[50px] flex items-center justify-center">
                    Student/Admission/BBA
                </div>
                <div class="space-y-[21px]">
                    <div class="relative">
                        <div class="absolute top-[20px] z-[-1] mx-auto w-full bg-[#707070] h-1">
                        </div>
                        <div class="flex justify-between text-white">
                            <div class="h-[44px] w-[44px] rounded-full bg-[#FF8C40] flex justify-center items-center">1</div>
                            <div class="h-[44px] w-[44px] rounded-full bg-[#3E3E3E] flex justify-center items-center">2</div>
                            <div class="h-[44px] w-[44px] rounded-full bg-[#3E3E3E] flex justify-center items-center">3</div>
                            <div class="h-[44px] w-[44px] rounded-full bg-[#3E3E3E] flex justify-center items-center">4</div>
                            <div class="h-[44px] w-[44px] rounded-full bg-[#3E3E3E] flex justify-center items-center">5</div>
                        </div>
                    </div>
                    <div class="">
                        <ul class="relative space-y-[15px]">
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Academic Session*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Year - Semester *</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Course Code*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Corse Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Corse Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Fee Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Fee Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Fee Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                            <div class="flex flex-row">
                                <li class="flex justify-between w-[245px]"><span>Fee Title*</span><span>:</span></li>
                                <input type="text" class="focus:outline-none px-[2px]">
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="flex justify-end space-x-[8px] text-white text-[20px] font-semibold"><span
                        class="w-[164px] h-[33px] flex items-center justify-center bg-[#3E3E3E] cursor-pointer">Add</span><span
                        class="w-[164px] h-[33px] flex items-center justify-center bg-[#FF8C40] cursor-pointer">Save</span>
                </div>
            </div>
@endsection --}}
