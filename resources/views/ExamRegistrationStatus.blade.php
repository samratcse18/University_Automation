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
    @php
        use App\Models\Department;
        use App\Models\Session;
        $dept = Department::orderBy('department', 'asc')->get();
        $sess = Session::orderBy('session', 'desc')->get();
    @endphp
    <form action="{{ route('admin.exportRegistrationPdf') }}" class="mt-2 space-y-2 px-[8px] lg:px-0" method="POST">
        @csrf
        @cannot('office.dashboard')
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department</span><span>:</span></li>
                <select oninput="handle(event,value)" name="Department"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    @foreach ($dept as $item)
                        <option value="{{ $item->department }}">{{ $item->department }}</option>
                    @endforeach
                </select>
            </div>
        @endcannot
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Exam Type</span><span>:</span>
            </li>
            <select name="Exam" oninput="handle(event)"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="Select Religion" disabled selected>Select Type</option>
                <option value="Midterm"@if (old('Exam') == 'Midterm') {{ 'selected' }} @endif>Midterm</option>
                <option value="Final" @if (old('Exam') == 'Final') {{ 'selected' }} @endif>Final</option>
                <option value="others" @if (old('Exam') == 'others') {{ 'selected' }} @endif>others</option>
            </select>
        </div>
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Exam Category</span><span>:</span>
            </li>
            <select name="Exam_Category" oninput="handle(event)"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="Select Type" disabled selected>Select Type</option>
                <option value="Current Semester" @if (old('Exam_Category') == 'Current Semester') {{ 'selected' }} @endif>Current
                    Semester</option>
                <option value="Improvement" @if (old('Exam_Category') == 'Improvement') {{ 'selected' }} @endif>Improvement
                </option>
                <option value="Backlog" @if (old('Exam_Category') == 'Backlog') {{ 'selected' }} @endif>Backlog</option>
            </select>
        </div>
        <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program Type</span><span>:</span></li>
            <select oninput="handle(event,value)" name="Program_Type"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Select Option</option>
                <option value="Regular">Regular</option>
                <option value="Professional">Professional</option>
            </select>
        </div>
        <div id="session" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="Session"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Select Option</option>
                @foreach ($data as $item)
                    <option value="{{ $item->session }}">{{ $item->session }}</option>
                @endforeach
            </select>
        </div>
        <div id="professional_session" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="Session"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Select Option</option>
                @foreach ($professionalSession as $item)
                    <option value="{{ $item->professional_session }}">{{ $item->professional_session }}</option>
                @endforeach
            </select>
        </div>
        <div id="class" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Class</span><span>:</span></li>
            <select name="Class" oninput="handle(event,value)"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Select Option</option>
                <option value="Under Graduation" @if (old('Class') == 'Under Graduation') {{ 'selected' }} @endif>Under
                    Graduation</option>
                <option value="Post Graduation" @if (old('Class') == 'Post Graduation') {{ 'selected' }} @endif>Post
                    Graduation
                </option>
            </select>
        </div>
        <div id="Year" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Year-Semester</span><span>:</span></li>
            <select name="Semester" id="Year-Semester"
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
            </select>
        </div>
        <div id="Semester" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Semester</span><span>:</span></li>
            <select name="Semester" id="Semester"
                class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                <option value="" disabled selected>Select Option</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
                <option value="3rd Semester">3rd Semester</option>
                <option value="4th Semester">4th Semester</option>
                <option value="5th Semester">5th Semester</option>
                <option value="6th Semester">6th Semester</option>
                <option value="7th Semester">7th Semester</option>
                <option value="8th Semester">8th Semester</option>
                <option value="9th Semester">9th Semester</option>
                <option value="10th Semester">10th Semester</option>
            </select>
        </div>
        <div class="mt-5 text-center" id="submit" hidden>
            <input type="submit" value="Download Pdf"
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
        let data = {};

        function handle(e, value) {
            Class.hidden = false;
            Year.hidden = true;
            Semester.hidden = true;
            submit.hidden = true;
            data = {
                ...data,
                [e.target.name]: e.target.value,
            };
            if (data.Class == "Under Graduation") {
                Year.hidden = false;
                submit.hidden = false;
            } else if (data.Class == "Post Graduation") {
                Semester.hidden = false;
                submit.hidden = false;
            } else if (data.Program_Type == "Regular") {
                session.hidden = false;
                professional_session.hidden = true;
            } else if (data.Program_Type == "Professional") {
                professional_session.hidden = false;
                session.hidden = true;
            }
        }
    </script>
@endsection
