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
    <form action="{{ route('student.admissionData') }}"
        class="mt-2 space-y-2 px-[8px] lg:px-0" method="POST">
        @csrf
        @if (empty(Auth::guard('student')->user()->current_semester))
            <div class="text-red-600 border-b-2 border-[#006666] my-3">Admission Status: Not Admitted</div>
        @else
            <div class="text-green-500 border-b-2 border-[#006666] my-3">Admission Status: {{Auth::guard('student')->user()->current_semester}}</div>
        @endif
        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Admission Type</span><span>:</span></li>
            <select oninput="handle(event,value)" name="type"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Select Option</option>
                <option value="Regular">Regular</option>
                <option value="Professional">Professional</option>
            </select>
        </div>
        <div id="session" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="Session" class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Select Option</option>
                @foreach ($data as $item)
                    <option value="{{ $item->session }}">{{ $item->session }}</option>
                @endforeach
            </select>
        </div>
        <div id="professional_session" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span></li>
            <select name="professional_session"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Select Option</option>
                @foreach ($ProfessionalSession as $item)
                    <option value="{{ $item->professional_session }}">{{ $item->professional_session }}</option>
                @endforeach
            </select>
        </div>
        <div id="class" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Class</span><span>:</span></li>
            <select name="Class" onchange="handle(event,value)"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option value="" disabled selected>Select Option</option>
                <option value="Under Graduation" @if (old('Class') == 'Under Graduation') {{ 'selected' }} @endif>Under
                    Graduation</option>
                <option value="Post Graduation" @if (old('Class') == 'Post Graduation') {{ 'selected' }} @endif>Post Graduation
                </option>
            </select>
        </div>
        <img src="{{ asset('images/Rolling.gif') }}" id="rolling"
            class="w-[60px] mx-auto" alt="" hidden>
        <div id="div" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program</span><span>:</span></li>
            <select name="Program" id="Program"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                <option selected>Select Option</option>
            </select>
        </div>
        <div id="Year" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Year-Semester</span><span>:</span></li>
            <select name="Year_Semester" id="Year-Semester"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
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
        <div id="Semester" class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full" hidden>
            <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Semester</span><span>:</span></li>
            <select name="Semester" id="Semester"
                class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
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
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script>
        const select = document.getElementById("Program");
        const Class = document.getElementById("class");
        const session = document.getElementById("session");
        const professional_session = document.getElementById("professional_session");
        const rolling = document.getElementById('rolling');
        const div = document.getElementById('div');
        const Year = document.getElementById('Year');
        const Semester = document.getElementById('Semester');
        const submit = document.getElementById('submit');
        let data = {};
        function handle(e,value) {
            rolling.hidden=false;
            Class.hidden=false;
            div.hidden=true;
            Year.hidden=true;
            Semester.hidden=true;
            submit.hidden=true;
            data = {
                ...data,
                [e.target.name]: e.target.value,
            };
            if (e.target.name == "Class" && data.type == "Regular") {
                select.innerHTML = "<option selected>Select Option</option>";
                axios.post("{{ route('student.admissionLevel') }}", data)
                    .then((res) => {
                        res.data.map((item) => {
                            let option = document.createElement("option");
                            option.textContent = item.degree_name;
                            option.value = item.degree_name;
                            select.appendChild(option);
                        });
                        rolling.hidden=true;
                        div.hidden=false;
                        submit.hidden=false;
                        if (data.Class=='Under Graduation') {
                            Year.hidden=false;
                        }
                        else{
                            Semester.hidden=false;
                        }
                    }).catch((err) => {
                        console.log(err);
                    });
            } else if (e.target.name == "Class"&&data.type == "Professional") {
                select.innerHTML = "<option selected>Select Option</option>";
                axios.post("{{ route('student.admissionLevel') }}", data)
                    .then((res) => {
                        res.data.map((item) => {
                            let option = document.createElement("option");
                            option.textContent = item.special_degree;
                            option.value = item.special_degree;
                            select.appendChild(option);
                        });
                        rolling.hidden=true;
                        div.hidden=false;
                        submit.hidden=false;
                        if (data.Class=='Under Graduation') {
                            Year.hidden=false;
                        }
                        else{
                            Semester.hidden=false;
                        }
                    }).catch((err) => {
                        console.log(err);
                    });
            } else if (data.type == "Regular") {
                session.hidden=false;
                professional_session.hidden=true;
                rolling.hidden=true;
            } else if (data.type == "Professional") {
                professional_session.hidden=false;
                session.hidden=true;
                rolling.hidden=true;
            }
        }
    </script>
@endsection
