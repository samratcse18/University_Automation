<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <!-- <link rel="stylesheet" href="main.css"> -->
    <script src="https://kit.fontawesome.com/1e24885529.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Dashboard</title>
    @section('styleDevDept')
    @show
</head>

<body>
    @php
        use App\Models\HallCircular;
        $user = Auth::guard('admin')->user();
        if ($user) {
            $notice = HallCircular::where('dept', $user->dept)
                ->orderBy('created_at', 'desc')
                ->get();
            $circular = HallCircular::all();
        }
        else {
            $notice = HallCircular::where('dept', Auth::guard('student')->user()->dept)
                ->orderBy('created_at', 'desc')
                ->get();
            $circular = HallCircular::all();
        }
    @endphp
    <div class="flex justify-between overflow-hidden lg:space-x-[36px] lg:p-5">
        <i onclick="nav()" id="icon"
            class="fa fa-bars absolute right-1 z-30 mr-2 mt-2 cursor-pointer text-2xl lg:invisible"
            aria-hidden="true"></i>
        <div id="nav_slide"
            class="absolute z-20 -ml-[820px] h-[100vh] w-[100%] bg-[#E2E2E2] lg:relative lg:z-0 lg:ml-0 lg:h-auto lg:w-[253px]">
            <div class="avater_nav flex justify-between bg-[#006666] p-2">
                @can('superAdmin.dashboard')
                    <h1 class="text-xl text-white">Super Admin Zone</h1>
                @endcan
                @can('student.dashboard')
                    <h1 class="text-xl text-white">Student Zone</h1>
                @endcan
                @can('controller.dashboard')
                    <h1 class="text-xl text-white">Controller Zone</h1>
                @endcan
                @can('office.dashboard')
                    <h1 class="text-xl text-white">Office Zone</h1>
                @endcan
                @can('provost.dashboard')
                    <h1 class="text-xl text-white">Hall Zone</h1>
                @endcan
                @if (($user && $user->hasExactRoles(['admin', 'teacher'])) || ($user && $user->hasExactRoles('admin')))
                    <h1 class="text-xl text-white">Chairman Zone</h1>
                @endif
                @if (($user && $user->hasExactRoles(['dean', 'admin', 'teacher'])) ||
                    ($user && $user->hasExactRoles(['dean', 'teacher'])) ||
                    ($user && $user->hasExactRoles('dean')))
                    <h1 class="text-xl text-white">Dean Zone</h1>
                @endif
                @if (Auth::guard('bank')->user())
                    <h1 class="text-xl text-white">Bank Zone</h1>
                @endif
            </div>
            <div class="avatar flex h-[200px] flex-col items-center justify-center">
                @if (Auth::guard('student')->user())
                    @php
                        $img = Auth::guard('student')->user()->img;
                    @endphp
                    <img class="h-[100px] w-[100px] rounded-full" src="{{ asset('images/' . $img) }}" alt="">
                    <h1>{{ Auth::guard('student')->user()->fname }} {{ Auth::guard('student')->user()->lname }}</h1>
                    <h1>{{ Auth::guard('student')->user()->email }}</h1>
                @endif
                @if ($user)
                    @if ($user->img)
                        <img class="h-[100px] w-[100px] rounded-full" src="{{ asset('images/'.$user->img) }}" alt="">
                    @else
                        <img class="h-[100px] w-[100px] rounded-full bg-white"
                            src="https://img.icons8.com/officel/80/null/school-director-male-skin-type-6.png" />
                    @endif
                    <h1>{{ $user->fname }} {{ $user->lname }}</h1>
                    <h1>{{ $user->email }}</h1>
                @endif
                @if (Auth::guard('bank')->user())
                    <img
                        class="w-24"src="https://img.icons8.com/external-smashingstocks-flat-smashing-stocks/66/null/external-manager-hotel-smashingstocks-flat-smashing-stocks-2.png" />
                    <h1>{{ Auth::guard('bank')->user()->fname }} {{ Auth::guard('bank')->user()->lname }}</h1>
                    <h1>{{ Auth::guard('bank')->user()->email }}</h1>
                @endif
            </div>
            <div>
                <ul>
                    @if (Auth::guard('student')->user())
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ url('/student') }}">Dashboard</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.studentProfile') }}">Profile Update</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.admission') }}">Admission</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.assignment') }}">Assignment</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ url('student/exam_registration') }}">Exam Registration</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.applyHall') }}">Apply Hall</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.certificate') }}">Certificate</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.testmonial') }}">Testmonial</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.studentReferenceLetterList') }}">Reference Letter</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.routineView') }}">Routine</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('student.logout') }}">Log out</a></li>
                    @endif
                    @if ($user)
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ url('/home') }}">Dashboard</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('admin.profileUpdate') }}">Update Profile</a>
                        </li>
                        @can('superAdmin.dashboard')
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.faculty') }}">Faculty</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.dean') }}">Dean</a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.hall') }}">Hall</a>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.provost') }}">Provost</a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.controller') }}">Controller</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.session') }}">Session Reg</a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.professionalSession') }}">Session Pro</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.account') }}">Account</a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.fee') }}">Add Fee</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a href="">Records</a>
                            </li>
                        @endcan
                        @can('dean.dashboard')
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.department') }}">Department</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.chairman') }}">Chairman</a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.degree') }}">Regular Degree</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.specialDegree') }}">Professional Degree</a>
                            </li>
                        @endcan
                        @can('admin.dashboard')
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.fee') }}">Add Fee</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.account') }}">Account</a>
                            </li>
                        @endcan
                        @if ($user->hasExactRoles('teacher'))
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('teacher.teacherRoutineView') }}">Class Schedule</a>

                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('teacher.studentAttendanceView') }}">Attendance</a>

                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('teacher.courseAssigmentList') }}">Assignment</a>
                            </li>
                        @endif
                        @can('office.dashboard')
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.routine') }}">Class Routine</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('office.letters') }}">Meeting Letter</a>
                            </li>
    
                            <!--<li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a-->
                            <!--        href="{{ route('admin.meetingmins') }}">Meeting Mins</a>-->
                            <!--</li>-->
                            <!--<li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a-->
                            <!--        href="{{ route('admin.noticeWritingView') }}">All notices </a>-->
                            <!--</li>-->
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('admin.complainsList') }}">Student complains </a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('office.testimonialList') }}">Testimonial </a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('office.InstructionCertificateList') }}">MOI Certificate </a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('office.referenceLetterList') }}">Reference Letter </a>
                            </li>
                            <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('dept_course') }}">Depertment Coruse</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('dept.roomlist') }}">Depertment room</a>
                            </li>
                            <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                    href="{{ route('office.semesterDurationList') }}">Semester Duration</a>
                            </li>
                        @endcan
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a href="{{ route('admin.logout') }}">Log out</a></li>
                    @endif
                    @if (Auth::guard('bank')->user())
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ url('/bank') }}">Dashboard</a>
                        </li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('bank.profileUpdate') }}">Profile Update</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('bank.scan') }}">Admission Status Scan</a></li>
                        <li class="c h-14 bg-[#3E3E3E] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('bank.statement') }}">Statement</a>
                        </li>
                        <li class="c h-14 bg-[#006666] p-2 text-white hover:bg-[#1AA2A2]"><a
                                href="{{ route('bank.logout') }}">Log out</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div id="2nd_div" class="z-10 w-[100%] lg:relative lg:w-[760px] 2xl:w-[1280px]">
            <div class="space-y-2 bg-[#006666] p-4 text-center text-white">
                @if (($user && $user->hasExactRoles(['dean', 'admin', 'teacher'])) ||
                    ($user && $user->hasExactRoles(['dean', 'teacher'])) ||
                    ($user && $user->hasExactRoles('dean')))
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Dean Panel
                    </div>
                @endif
                @if (($user && $user->hasExactRoles(['admin', 'teacher'])) || ($user && $user->hasExactRoles('admin')))
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Chairman Panel
                    </div>
                    <div class="text-xl font-bold">Department of <span
                            class="uppercase">{{ Auth::guard('admin')->user()->dept }}</span> </div>
                @endif
                @can('student.dashboard')
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Student Panel
                    </div>
                    <div class="text-xl font-bold">Department of <span
                            class="uppercase">{{ Auth::guard('student')->user()->dept }}</span> </div>
                @endcan
                @if (Auth::guard('bank')->user())
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Bank Panel
                    </div>
                @endif
                @can('office.dashboard')
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Office Staff Panel
                    </div>
                    <div class="text-xl font-bold">Department of <span
                            class="uppercase">{{ Auth::guard('admin')->user()->dept }}</span> </div>
                @endcan
                @can('superAdmin.dashboard')
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Super Admin Panel
                    </div>
                @endcan
                @if ($user && $user->hasExactRoles('teacher'))
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Faculty Member Panel
                    </div>
                    <div class="text-xl font-bold">Department of <span
                            class="uppercase">{{ Auth::guard('admin')->user()->dept }}</span> </div>
                @endif
                @if ($user && $user->hasExactRoles('controller'))
                    <div class="text-[22px] font-semibold lg:text-[40px]">
                        Controller Panel
                    </div>
                @endif
                <div class="text-[20px]">{{ date('l, jS F Y') }}</div>
                @section('divHeadTitle')
                @show()
            </div>
            <?php $num = 1; ?>
            @section('content')
            @show
            @if (session('massage'))
                <div class="bg-red-500 text-3xl">{{ session('massage') }}</div>
            @endif
        </div>
        <div class="absolute -top-[1000px] space-y-[12px] bg-[#ffffff] lg:relative lg:top-0 lg:w-[253px]">
            <div
                class="nav box-border flex h-[50px] items-center justify-between bg-[#006666] p-2 font-semibold text-white hover:bg-[#1AA2A2]">
                @if (Auth::guard('student')->user())
                    <a href="{{ route('student.logout') }}" class="hover:text-white"><h1>Log Out</h1></a>
                @elseif (Auth::guard('admin')->user())
                    <a href="{{ route('admin.logout') }}" class="hover:text-white"><h1>Log Out</h1></a>
                @elseif (Auth::guard('bank')->user())
                    <a href="{{ route('bank.logout') }}" class="hover:text-white"><h1>Log Out</h1></a>
                @endif
            </div>
            <div class="box-border flex h-[50px] items-center justify-between bg-[#3E3E3E] p-2">
                {{-- <i class="fa-solid fa-magnifying-glass text-white"></i> --}}
            </div>
            @cannot('student.dashboard')
                @foreach ($circular as $item)
                    @if (!empty($item->hall_name) && empty($item->dept) && ($item->type=='Circular' || $item->type=='Interview'))
                        <div class="text-left"><a href="{{ route('admin.circularView', ['id' => $item->id]) }}"
                                target="blank">{{ $item->hall_name }} Circular</a></div>
                    @endif
                @endforeach
                @foreach ($notice as $item2)
                    @if ($user && $item2->dept == $user->dept && ($item2->type=='Circular' || $item2->type=='Interview'))
                        <div class="text-left"><a href="{{ route('admin.circularView', ['id' => $item2->id]) }}"
                                target="blank">{{ date('d/m/Y', strtotime($item2->created_at)) }}: {{ $item2->dept }}
                                Circular</a></div>
                    @endif
                @endforeach
            @endcannot
            @can('student.dashboard')
                @foreach ($notice as $item2)
                    @if ($item2->dept == Auth::guard('student')->user()->dept && $item2->type=='Student')
                        <div class="text-left"><a href="{{ route('student.circularView', ['id' => $item2->id]) }}"
                                target="blank">{{ date('d/m/Y', strtotime($item2->created_at)) }}: {{ $item2->dept }}
                                Circular</a></div>
                    @endif
                @endforeach
            @endcan
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        let num = 1;

        function nav() {
            let icon = document.getElementById("icon").classList.contains("fa-bars");
            document.getElementById("nav_slide").classList.add("duration-1000");
            if (icon) {
                document.getElementById("icon").classList.replace("fa-bars", "fa-times");
                document.getElementById("nav_slide").classList.remove("-ml-[820px]");
                document.getElementById("2nd_div").classList.add("fixed");


            } else {
                document.getElementById("nav_slide").classList.add("-ml-[820px]");
                document.getElementById("icon").classList.replace("fa-times", "fa-bars");
                document.getElementById("2nd_div").classList.remove("fixed");
            }
        }
    </script>
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
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            @if (Session::has('err'))
                toastr.error('{{ Session::get('err') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif (Session::has('warning'))
                 toastr.options = {
                     "closeButton": true,
                     "positionClass": "toast-top-center",
                 }
                toastr.warning('{{ Session::get('warning') }}');
            @endif
        });
    </script>
    @section('scriptDevDept')
    @show
</body>

</html>
