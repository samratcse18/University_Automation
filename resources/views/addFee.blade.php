@extends('layouts.Dashboard')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.fee_submit') }}" method="POST">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Fee Title</span><span>:</span></li>
                <select name="Fee_Title" id=""
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @can('superAdmin.dashboard')
                        <option value="Admission Fee">Admission Fee</option>
                        <option value="Readmission Fee">Readmission Fee</option>
                        <option value="Registrasion Fee">Registrasion Fee</option>
                        <option value="Credit Fee">Credit Fee</option>
                        <option value="Tution Fee">Tution Fee</option>
                        <option value="Transport Fee">Transport Fee</option>
                        <option value="Medical Fee">Medical Fee</option>
                        <option value="Library Fee">Library Fee</option>
                        <option value="Sports and Culture">Sports and Culture</option>
                        <option value="Student Welfare">Student Welfare</option>
                        <option value="BNCC">BNCC</option>
                        <option value="Rover">Rover</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Library Mortgaze">Library Mortgaze</option>
                        <option value="Guidance & Counselling">Guidance & Counselling</option>
                        <option value="Yearly Calender">Yearly Calender</option>
                        <option value="Dairy">Dairy</option>
                        <option value="Panalty">Panalty</option>
                        <option value="Computer & Internet">Computer & Internet</option>
                        <option value="Others 2">Others 2</option>
                    @endcan
                    @can('provost.dashboard')
                        <option value="Seat Rent (Reg)">Seat Rent (Reg)</option>
                        <option value="Seat Rent (Gono)">Seat Rent (Gono)</option>
                        <option value="Fixures & Dev">Fixures & Dev</option>
                        <option value="Hall Admission Fee">Hall Admission Fee</option>
                        <option value="Hall Card Fee">Hall Card Fee</option>
                        <option value="Mortgaze">Mortgaze</option>
                        <option value="Hall Panalty">Hall Panalty</option>
                        <option value="Hall Attachment Fee">Hall Attachment Fee</option>
                        <option value="Hall Testimonial">Hall Testimonial</option>
                        <option value="Others 1">Others 1</option>
                        <option value="Others 2">Others 2</option>
                    @endcan
                    @can('admin.dashboard')
                        <option value="Association">Association</option>
                        <option value="Development">Development</option>
                        <option value="Withdrawal of Mark Sheet">Withdrawal of Mark Sheet</option>
                        <option value="Exam Hall Fee">Exam Hall Fee</option>
                        <option value="Testimonial/Other Services">Testimonial/Other Services</option>
                        <option value="Seminar">Seminar</option>
                        <option value="Syllabus">Syllabus</option>
                        <option value="Panalty">Panalty</option>
                        <option value="Mortgaze">Mortgaze</option>
                        <option value="Lab">Lab</option>
                        <option value="(Pro:Deg) Admission Fee">(Pro:Deg) Admission Fee</option>
                        <option value="(Pro:Deg) Tution Fee">(Pro:Deg) Tution Fee</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    @endcan
                    @can('controller.dashboard')
                        <option value="Certificate Fee(Reg)">Certificate Fee(Reg)</option>
                        <option value="Transcript Fee(Reg)">Transcript Fee(Reg)</option>
                        <option value="Certificate Fee(Emr)">Certificate Fee(Emr)</option>
                        <option value="Transcript Fee(Emr)">Transcript Fee(Emr)</option>
                        <option value="Exam Hall Fee">Exam Hall Fee</option>
                        <option value="Admit Card Fee">Admit Card Fee</option>
                        <option value="Other 1">Other 1</option>
                        <option value="Other 2">Other 2</option>
                    @endcan

                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Account Number</span><span>:</span></li>
                <select name="Account_Number" id=""
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->account }}" @if (old('Account_Number') == '{{ $item->account }}') {{ 'selected' }} @endif>
                            {{ $item->account }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Amount</span><span>:</span></li>
                <input type="number" placeholder="Enter Amount" name="Amount" value="{{ old('Amount') }}"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            @can('superAdmin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>For</span><span>:</span></li>
                    <select name="Type"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Exam">Exam</option>
                        <option value="Admission">Admission</option>
                    </select>
                </div>
            @endcan
            @can('admin.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>For</span><span>:</span></li>
                    <select name="Type" oninput="handle(event)"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Exam">Exam</option>
                        <option value="Admission">Admission</option>
                        <option value="Service">Service</option>
                    </select>
                </div>
            @endcan
            @cannot('provost.dashboard')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program Type</span><span>:</span></li>
                    <select oninput="handle(event,value)" name="program_type"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Regular">Regular</option>
                        <option value="Professional">Professional</option>
                    </select>
                </div>
            @endcannot
            <div id="session" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                @cannot('controller.dashboard')
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
                @endcannot
                @can('controller.dashboard')
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Form Session</span><span>:</span></li>
                @endcan
                <select name="session"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($session as $item)
                        <option value="{{ $item->session }}">{{ $item->session }}</option>
                    @endforeach
                </select>
            </div>
            <div id="professional_session" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around"
                hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
                <select name="session"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($professionalSession as $item)
                        <option value="{{ $item->professional_session }}">{{ $item->professional_session }}</option>
                    @endforeach
                </select>
            </div>
            <div id="class" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Class</span><span>:</span></li>
                <select name="Class" onchange="handle(event,value)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="Under Graduation" @if (old('Class') == 'Under Graduation') {{ 'selected' }} @endif>Under
                        Graduation</option>
                    <option value="Post Graduation" @if (old('Class') == 'Post Graduation') {{ 'selected' }} @endif>Post
                        Graduation
                    </option>
                </select>
            </div>
            @cannot('controller.dashboard')
                <div id="Year" class="flex flex-col justify-start lg:w-full lg:justify-around" hidden>
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Year-Semester</span></li>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="1st Year-1st Semester">1st Year-1st Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="1st Year-2nd Semester">1st Year-2nd Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="2nd Year-1st Semester">2nd Year-1st Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="2nd Year-2nd Semester">2nd Year-2nd Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="3rd Year-1st Semester">3rd Year-1st Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="3rd Year-2nd Semester">3rd Year-2nd Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="4th Year-1st Semester">4th Year-1st Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="4th Year-2nd Semester">4th Year-2nd Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="5th Year-1st Semester">5th Year-1st Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id=""
                            value="5th Year-2nd Semester">5th Year-2nd Semester
                    </div>
                    {{-- <select name="Year_Semester" id="Year-Semester"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="1st Year-1st Semester">1st Year-1st Semester</option>
                    <option value="1st Year-2nd Semester">1st Year-2nd Semester</option>
                    <option value="2nd Year-1st Semester">2nd Year-1st Semester</option>
                    <option value="2nd Year-2nd Semester">2nd Year-2nd Semester</option>
                    <option value="3rd Year-1st Semester">3rd Year-1st Semester</option>
                    <option value="3rd Year-2nd Semester">3rd Year-2nd Semester</option>
                    <option value="4th Year-1st Semester">4th Year-1st Semester</option>
                    <option value="4th Year-2nd Semester">4th Year-2nd Semester</option>
                    <option value="5th Year-1st Semester">5th Year-1st Semester</option>
                    <option value="5th Year-2nd Semester">5th Year-2nd Semester</option>
                </select> --}}
                </div>
                <div id="Semester" class="flex flex-col justify-start lg:w-full lg:justify-around" hidden>
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Semester</span></li>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="1st Semester">1st
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="2nd Semester">2nd
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="3rd Semester">3rd
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="4th Semester">4th
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="5th Semester">5th
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="6th Semester">6th
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="7th Semester">8th
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="9th Semester">9th
                        Semester
                    </div>
                    <div class="">
                        <input type="checkbox" name="semester[]" class="h-4 w-4" id="" value="10th Semester">10th
                        Semester
                    </div>
                </div>
            @endcannot
            <div id="Service" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Service</span><span>:</span></li>
                <select oninput="handle(event,value)" name="service"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="Certificate">Certificate</option>
                    <option value="Testmonial">Testmonial</option>
                    <option value="Letter">Letter</option>
                    <option value="Other 1">Other 1</option>
                </select>
            </div>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script>
        const select = document.getElementById("Program");
        const Class = document.getElementById("class");
        const session = document.getElementById("session");
        const professional_session = document.getElementById("professional_session");
        const Year = document.getElementById('Year');
        const Semester = document.getElementById('Semester');
        const submit = document.getElementById('submit');
        const Service = document.getElementById('Service');
        let data = {};

        function handle(e, value) {
            Class.hidden = false;
            data = {
                ...data,
                [e.target.name]: e.target.value,
            };

            if (data.program_type == "Regular" && data.Type != 'Service') {
                session.hidden = false;
                professional_session.hidden = true;
            } else if (data.program_type == "Professional" && data.Type != 'Service') {
                professional_session.hidden = false;
                session.hidden = true;
            }
            if (data.Class == 'Under Graduation') {
                Year.hidden = false;
                Semester.hidden = true;
            } else if (data.Class == 'Post Graduation') {
                Year.hidden = true;
                Semester.hidden = false;
            }

            if (data.Type == 'Service') {
                Service.hidden = false;
                session.hidden = true;
                Semester.hidden = true;
                Year.hidden = true;
            } else if (data.Type == 'Exam' && data.program_type == "Regular") {
                Service.hidden = true;
            }
        }
    </script>
@endsection
