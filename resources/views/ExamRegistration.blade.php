@extends('layouts.Dashboard')

@section('content')
    @php
        $user = Auth::guard('student')->user();
    @endphp
    @if (empty($user->signature))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "positionClass": "toast-top-center",
                }
                toastr.error('Please Add Your Signature First');
            });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $(document).ready(function() {
                    toastr.options = {
                        "positionClass": "toast-top-center",
                    }
                    toastr.error('{{ $error }}');
                });
            </script>
        @endforeach
    @endif
    <form action="{{ route('student.examRegistrationData') }}">
        <div id="step1" class="mt-2 space-y-2 px-[8px] lg:px-0">
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
            <div id="class" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program Level</span><span>:</span></li>
                <select name="Degree_Level" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="" disabled selected>Select Option</option>
                    <option value="Under Graduation" @if (old('Degree_Level') == 'Under Graduation') {{ 'selected' }} @endif>Under
                        Graduation</option>
                    <option value="Post Graduation" @if (old('Degree_Level') == 'Post Graduation') {{ 'selected' }} @endif>Post
                        Graduation
                    </option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program type</span><span>:</span>
                </li>
                <select name="Program_type" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select Type" disabled selected>Select Type</option>
                    <option value="Regular"@if (old('Program_type') == 'Regular') {{ 'selected' }} @endif>Regular</option>
                    <option value="Professional"@if (old('Program_type') == 'Professional') {{ 'selected' }} @endif>Professional
                    </option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Program Name</span><span>:</span>
                </li>
                <select name="Program_Name" id="Program_Name" oninput="handle(event)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select Name" disabled selected>Select Name</option>
                </select>
            </div>
            <div class="my-5 text-center">
                <div onclick="action()"
                    class="mx-auto w-[100px] cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
                    Next</div>
            </div>
        </div>
        <div id="step2" class="mt-2 space-y-2 px-[8px] lg:px-0" hidden>
            <div class="space-y-2" id="into">
                <div id="reg" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Current Session</span><span>:</span>
                    </li>
                    <select name="Current_Session[]"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="Select Session" disabled selected>Select Session</option>
                        @foreach ($session as $item)
                            <option
                                value="{{ $item->session }}"@if (old('Current_Session') == $item->session) {{ 'selected' }} @endif>
                                {{ $item->session }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="pro" class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around" hidden>
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Current Session</span><span>:</span>
                    </li>
                    <select name="Current_Session[]"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="Select Session" disabled selected>Select Session</option>
                        @foreach ($ProfessionalSession as $item)
                            <option
                                value="{{ $item->professional_session }}"@if (old('Current_Session') == $item->professional_session) {{ 'selected' }} @endif>
                                {{ $item->professional_session }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="Year" class="" hidden>
                    <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                        <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Year-Semester</span><span>:</span></li>
                        <select name="Semester" id="Year-Semester" oninput="handle(event)"
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
                </div>
                <div id="Semester" class="" hidden>
                    <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                        <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Semester</span><span>:</span></li>
                        <select name="Semester" id="semester" oninput="handle(event)"
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
                </div>
            </div>
            <div class="text-left" id="addBtn">
                <div onclick="addbtn()"
                    class="w-24 cursor-pointer bg-[#006666] px-4 text-center text-[20px] text-white hover:bg-[#0fe3e3]">Add
                </div>
            </div>
        </div>
        <img src="{{ asset('images/Rolling.gif') }}" id="rolling"
        class="w-[60px] mx-auto mt-10" alt="" hidden>
        <div class="my-5 text-center" id="submit" hidden>
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script>
        let data = {};
        let j = 0;
        const year = document.getElementById('Year');
        const semester = document.getElementById('Semester');
        const div = document.getElementById('step1');
        const div2 = document.getElementById('step2');
        const pro = document.getElementById('pro');
        const reg = document.getElementById('reg');
        const into = document.getElementById('into');
        const addBtn = document.getElementById('addBtn');
        const submit = document.getElementById('submit');
        const rolling = document.getElementById('rolling');
        let nonHiddenChildren = [...into.children].filter(child => child.offsetParent !== null);
        let i = 0;

        function handle(e) {
            data = {
                ...data,
                [e.target.name]: e.target.value,
            };
            if (e.target.name == 'Semester') {
                rolling.hidden=false;
                div2.hidden=true;
                let parentId = document.getElementById(e.target.id).parentNode.parentNode.id;
                let parentElement = document.getElementById(parentId);
                let container = document.createElement('div');
                axios.post("{{ route('student.course') }}", data)
                    .then((res) => {
                        if (parentElement.children.length > 1) {
                            parentElement.removeChild(parentElement.lastElementChild);
                        }
                        container.innerHTML = res.data;
                        parentElement.append(container);
                        rolling.hidden=true;
                        div2.hidden=false;
                    }).catch((err) => {
                        console.log(err);
                    });
            } else if (e.target.name == 'Program_type') {
                const mm = document.getElementById('Program_Name');
                axios.post("{{ route('student.program_type') }}", data)
                    .then((res) => {
                        mm.innerHTML = res.data;
                    }).catch((err) => {
                        console.log(err);
                    });
            }
        }

        function sum(n, e) {
            if (e.target.checked == true) {
                j = j + n;
            } else {
                j = j - n;
            }
            if (data.Exam_Category == 'Backlog') {
                if (j <= 12) {
                    toastr.success(`Your Selected Credit ${j} of 12 Credit`);
                    submit.hidden=false;
                } else {
                    submit.hidden=true;
                    toastr.error(`Your Selected Credit ${j} of 12 Credit`);
                }
            }
        }

        function action() {
            if (data && data.Exam_Category == 'Current Semester') {
                addBtn.hidden = true;
            } else {
                addBtn.hidden = false;
            }
            if (data && data.Exam && data.Exam_Category && data.Degree_Level && data.Program_type && data.Program_Name) {
                div.hidden = true;
                div2.hidden = false;
                submit.hidden = false
                if (data.Program_type == 'Regular') {
                    reg.hidden = false;
                    pro.hidden = true;
                } else {
                    reg.hidden = true;
                    pro.hidden = false;
                }
                if (data.Degree_Level == 'Under Graduation') {
                    year.hidden = false;
                    semester.hidden = true;
                } else {
                    year.hidden = true;
                    semester.hidden = false;
                }
            } else {
                toastr.error('Please Fill all Option');
            }

        }

        function addbtn() {
            nonHiddenChildren = [...into.children].filter(child => child.offsetParent !== null);
            let thala1 = document.createElement('div');
            let thala2 = document.createElement('div');
            thala2.setAttribute('id', `myDiv${++i}`);
            thala1.classList.add('flex', 'flex-col', 'justify-start', 'lg:w-full', 'lg:flex-row', 'lg:justify-around');
            // thala2.classList.add('flex', 'flex-col', 'justify-start', 'lg:w-full', 'lg:flex-row', 'lg:justify-around');
            thala1.innerHTML = nonHiddenChildren[0].innerHTML;
            thala2.innerHTML = nonHiddenChildren[1].innerHTML;
            thala2.children[0].children[1].id = `id${++i}`;
            if (thala2.children.length > 1) {
                thala2.removeChild(thala2.lastElementChild);
            }
            into.append(thala1);
            into.append(thala2);
        }
    </script>
@endsection
