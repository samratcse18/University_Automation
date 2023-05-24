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
        use App\Models\ProfessionalSession;
        use App\Models\Session;
        $sess = ProfessionalSession::orderBy('professional_session', 'desc')->get();
        $sessReg = Session::orderBy('session', 'desc')->get();
        $user = Auth::guard('student')->user();
    @endphp
    <form action="{{ route('student.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>First Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" placeholder="Please Enter" name="FirstName"
                    value="{{ $user->fname }}"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Last Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->lname }}" placeholder="Please Enter"
                    name="LastName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Email</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->email }}" placeholder="Please Enter"
                    name="Email"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Department</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->dept }}" placeholder="Please Enter"
                    name="Department"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            @if ($user->dept == 'FBS')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span>
                    </li>
                    <select name="Session"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option disabled selected>Select Session</option>
                        @foreach ($sess as $item)
                            <option value="{{ $item->professional_session }}" @if ($user->session==$item->professional_session)
                                {{'selected'}}@endif>{{ $item->professional_session }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Session</span><span>:</span>
                    </li>
                    <select name="Session"
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option disabled selected>Select Session</option>
                        @foreach ($sessReg as $item)
                            <option value="{{ $item->session }}" @if ($user->session==$item->session)
                                {{'selected'}}@endif>{{ $item->session }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Student Id</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->student_id }}"
                    placeholder="Please Enter" name="Student_Id"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Admission Roll</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->admission_roll }}"
                    placeholder="Please Enter" name="Admission_Roll"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Phone</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->phone }}" placeholder="Please Enter"
                    name="Phone"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Gender</span><span>:</span>
                </li>
                <select name="Gender" onchange="handle(name,value)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select Religion" disabled selected>Select Gender</option>
                    <option value="Male"@if ($user->gender == 'Male') {{ 'selected' }} @endif>Male</option>
                    <option value="Female" @if ($user->gender == 'Female') {{ 'selected' }} @endif>Female</option>
                </select>
            </div>
            @if ($user->dept != 'FBS')
                <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                    <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Hall Name</span><span>:</span></li>
                    <select name="Hall_Name" id=""
                        class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                        <option value="" disabled selected>Select Option</option>
                        @foreach ($hall as $item)
                            <option
                                value="{{ $item->name }}"@if ($user->Hall == $item->name) {{ 'selected' }} @endif>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Registration Number</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->RegistrationNumber }}"
                    placeholder="Please Enter" name="RegistrationNumber"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Applicant Name(equivalent your SSC
                        certificate)</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->ApplicantName }}"
                    placeholder="Please Enter" name="ApplicantName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Father's Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->FatherName }}"
                    placeholder="Please Enter" name="FatherName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Mother's Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->MotherName }}"
                    placeholder="Please Enter" name="MotherName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Permanent Address</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->PermanentAddress }}"
                    placeholder="Please Enter" name="PermanentAddress"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Current Address</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->CurrentAddress }}"
                    placeholder="Please Enter" name="CurrentAddress"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Guardian's Name</span><span>:</span>
                </li>
                <input type="text" onchange="handle(name,value)" value="{{ $user->GuardianName }}"
                    placeholder="Please Enter" name="GuardianName"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Guardian's Phone Number</span><span>:</span>
                </li>
                <input type="number" min="0" onchange="handle(name,value)" value="{{ $user->GuardianNumber }}"
                    placeholder="Please Enter" name="GuardianNumber"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Your Nationality</span><span>:</span></li>
                <select name="Nationality" onchange="handle(name,value)" onclick="country()"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    id="Nationality">
                    <option value="Select Country" disabled selected>Select Country</option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between">
                    <span>Your Religion</span><span>:</span>
                </li>
                <select name="Religion" onchange="handle(name,value)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select Religion" disabled selected>Select Religion</option>
                    <option value="Islam" @if ('Islam' == $user->Religion) {{ 'selected' }} @endif>Islam</option>
                    <option value="Hindu" @if ('Hindu' == $user->Religion) {{ 'selected' }} @endif>Hindu</option>
                    <option value="Christianity" @if ('Christianity' == $user->Religion) {{ 'selected' }} @endif>Christianity
                    </option>
                    <option value="Buddha" @if ('Buddha' == $user->Religion) {{ 'selected' }} @endif>Buddha</option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between">
                    <span>Blood Group</span><span>:</span>
                </li>
                <select name="BloodGroup" onchange="handle(name,value)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select BloodGroup" disabled selected>Select BloodGroup</option>
                    <option value="A+" @if ($user->BloodGroup == 'A+') {{ 'selected' }} @endif>A+</option>
                    <option value="B+"@if ($user->BloodGroup == 'B+') {{ 'selected' }} @endif>B+</option>
                    <option value="O+"@if ($user->BloodGroup == 'O+') {{ 'selected' }} @endif>O+</option>
                    <option value="AB+"@if ($user->BloodGroup == 'AB+') {{ 'selected' }} @endif>AB+</option>
                    <option value="A-"@if ($user->BloodGroup == 'A-') {{ 'selected' }} @endif>A-</option>
                    <option value="B-"@if ($user->BloodGroup == 'B-') {{ 'selected' }} @endif>B-</option>
                    <option value="O-"@if ($user->BloodGroup == 'O-') {{ 'selected' }} @endif>O-</option>
                    <option value="AB-"@if ($user->BloodGroup == 'AB-') {{ 'selected' }} @endif>AB-</option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="flex w-full lg:w-[40%] lg:justify-between">
                    <span>Date of Birth (equivalent SSC certificate)</span><span>:</span>
                </li>
                <input onchange="handle(name,value)" type="date" value="{{ $user->Birth }}"
                    placeholder="Please Enter" name="DateofBirth"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]" />
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Married Status</span><span>:</span>
                </li>
                <select name="MarriedStatus" onchange="handle(name,value)"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
                    <option value="Select Status" disabled selected>Select Status</option>
                    <option value="Married" @if ($user->MarriedStatus == 'Married') {{ 'selected' }} @endif>Married
                    </option>
                    <option value="Unmarried" @if ($user->MarriedStatus == 'Unmarried') {{ 'selected' }} @endif>Unmarried
                    </option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Password</span><span>:</span>
                </li>
                <input type="password" name="password" placeholder="Pelase Enter Your Password"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Confirm Password</span><span>:</span>
                </li>
                <input type="password" name="cpassword" placeholder="Pelase Enter Your Password"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Change Profile</span><span>:</span>
                </li>
                <input name="img"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    type="file">
            </div>
            <div class="flex flex-col justify-start lg:w-full lg:flex-row lg:justify-around">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Add Signature</span><span>:</span>
                </li>
                <input name="signature"
                    class="ml-0 border-2 border-[#006666] px-[2px] focus:outline-none lg:ml-[28px] lg:w-[60%]"
                    type="file">
            </div>
        </div>
        <div class="my-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>
    <script>
        function country() {
            axios.get('https://restcountries.com/v3.1/all')
                .then((res) => {
                    const select = document.getElementById("Nationality");
                    res.data.sort((a, b) => {
                        let x = a.name.common.toUpperCase(),
                            y = b.name.common.toUpperCase();
                        return x == y ? 0 : x > y ? 1 : -1;
                    }).map((item) => {
                        let option = document.createElement("option");
                        option.textContent = item.name.common;
                        option.value = item.name.common;
                        select.appendChild(option);
                    });
                    console.log(res.data);
                }).catch((err) => {
                    console.log(err);
                });
        }
        country();
    </script>
@endsection
