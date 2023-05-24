@extends('layouts.Dashboard')

@if ($id == 1)

    @section('step' . $id)

        <div id="2nd_div" class="w-[100%] space-y-0 lg:relative lg:mt-0 lg:w-[724px] lg:space-y-[19px]">

            <div class="content w-full space-y-[19px]">

                <div class="flex h-[50px] items-center justify-center bg-[#3E3E3E] text-[23px] font-semibold text-white">

                    Student/Admission/<span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>

                </div>

                <div class="space-y-[21px]">

                    <div class="relative">

                        <div class="absolute top-[20px] z-[-1] mx-auto h-1 w-full bg-[#707070]">

                        </div>

                        <div class="flex justify-between text-white">

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#006666]">1

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">2

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">3

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">4

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">5

                            </div>

                        </div>

                    </div>

                    <div class="">

                        <ul class="relative w-full space-y-[15px] overflow-x-auto px-4">

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Class</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Enter Your Class"

                                    id="Class" name="Class"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Semester</span><span>:</span></li>

                                <select name="Semester" id="" onchange="handle(name,value)"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                                    <option value="" disabled selected>Select Option</option>

                                    <option value="1">1</option>

                                    <option value="2">2</option>

                                </select>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Subject</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    value="{{ Auth::guard('student')->user()->dept }}" id="Subject" name="Subject"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    readonly>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Roll Number</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Enter Your Roll"

                                    name="RollNumber" id="RollNumber"

                                    value="{{ Auth::guard('student')->user()->student_id }}"

                                    class="w-full border-[1px] border-[#006666] px-[2px] uppercase focus:outline-none"

                                    readonly>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Registration Number</span><span>:</span>

                                </li>

                                <input type="text" onchange="handle(name,value)" placeholder="Enter Your Class"

                                    id="RegistrationNumber" name="RegistrationNumber"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Session</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    value="{{ Auth::guard('student')->user()->session }}" name="Session" id="Session"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    readonly>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Applicant Name (equivalent your SSC

                                        certificate)</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    id="ApplicantName" name="ApplicantName"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    required>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Father Name (Block Letters)

                                    </span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    id="FatherName" name="FatherName"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    required>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Mother Name (Block

                                        Letters)</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    id="MotherName" name="MotherName"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    required>

                            </div>

                        </ul>

                    </div>

                </div>

                <div class="flex justify-end space-x-[8px] text-[20px] font-semibold text-white">

                    <div class="flex flex-row space-x-2">

                        <input id="mehedi" type="submit"

                            class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#3E3E3E]"

                            value="Save" />

                        <span onclick="nextStep()"

                            class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#006666] hover:bg-[#0ef7f7]">Save&Continue</span>

                    </div>

                </div>

            </div>

        </div>

        <script>

            if (!localStorage.getItem("RollNumber") && !localStorage.getItem("Subject") && !localStorage.getItem("Session")) {

                localStorage.setItem('RollNumber', '{{ Auth::guard('student')->user()->student_id }}'.toUpperCase());

                localStorage.setItem('Subject', '{{ Auth::guard('student')->user()->dept }}'.toUpperCase());

                localStorage.setItem('Session', '{{ Auth::guard('student')->user()->session }}'.toUpperCase());

            }

            document.getElementById('MotherName').value = localStorage.getItem('MotherName');

            document.getElementById('RegistrationNumber').value = localStorage.getItem('RegistrationNumber');

            document.getElementById('FatherName').value = localStorage.getItem('FatherName');

            document.getElementById('ApplicantName').value = localStorage.getItem('ApplicantName');

            document.getElementById('Class').value = localStorage.getItem('Class');

            document.getElementById('Semester').value = localStorage.getItem('Semester');

            document.getElementById('Subject').value = localStorage.getItem('Subject');

            document.getElementById('RollNumber').value = localStorage.getItem('RollNumber');

            document.getElementById('Session').value = localStorage.getItem('Session');





            function handle(name, value) {

                console.log(name, value);

                localStorage.setItem(name, value);

            }



            function nextStep() {

                if (!localStorage.getItem('Class') || !localStorage.getItem('Semester') || !localStorage.getItem('Subject') || !

                    localStorage.getItem('RollNumber') || !localStorage.getItem('RegistrationNumber') || !localStorage.getItem(

                        'Session') || !localStorage.getItem('ApplicantName') || !localStorage.getItem('FatherName') || !

                    localStorage.getItem('MotherName')) {

                    toastr.options.timeOut = 5000;

                    toastr.error('Please Fill The All Filed');

                } else {

                    window.location.replace("{{ url('/student/form/2') }}");

                }

            }

        </script>

    @endsection

@endif

@if ($id == 2)

    @section('step' . $id)

        <div id="2nd_div" class="w-[100%] space-y-0 lg:relative lg:mt-0 lg:w-[724px] lg:space-y-[19px]">

            <div class="content w-full space-y-[19px]">

                <div class="flex h-[50px] items-center justify-center bg-[#3E3E3E] text-[23px] font-semibold text-white">

                    Student/Admission/<span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>

                </div>

                <div class="space-y-[21px]">

                    <div class="relative">

                        <div class="absolute top-[20px] z-[-1] mx-auto h-1 w-full bg-[#707070]">

                        </div>

                        <div class="flex justify-between text-white">

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">1

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#006666]">2

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">3

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">4

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">5

                            </div>

                        </div>

                    </div>

                    <div class="">

                        <ul class="relative w-full space-y-[15px] overflow-x-auto px-4">

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Permanent Address</span><span>:</span>

                                </li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="PermanentAddress" id="PermanentAddress"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Current Address</span><span>:</span>

                                </li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="CurrentAddress" id="CurrentAddress"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Phone Number</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Enter Your Number"

                                    name="PhoneNumber" id="PhoneNumber"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Email</span><span>:</span></li>

                                <input type="email" onchange="handle(name,value)" placeholder="Enter Your Email"

                                    value="{{ Auth::guard('student')->user()->email }}" name="Email" id="Email"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Guardian Name,Address,Relation (Absence

                                        Father)</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="GuardianName" id="GuardianName"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Phone Number

                                        (Guardian-Current)</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="GuardianCurrentPhoneNumber" id="GuardianCurrentPhoneNumber"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Permanent Guardian Name, Address,

                                        Relation</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="PermanentGuardianName" id="PermanentGuardianName"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Phone Number

                                        (Guardian-Permanent)</span><span>:</span></li>

                                <input type="text" onchange="handle(name,value)" placeholder="Please Enter"

                                    name="GuardianPermanentPhoneNumber" id="GuardianPermanentPhoneNumber"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between"><span>Nationality</span><span>:</span></li>

                                <select name="Nationality" onchange="handle(name,value)" onclick="country()"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none"

                                    id="Nationality">

                                    <option value="Select Country" disabled selected>Select Country</option>

                                </select>

                            </div>

                        </ul>

                    </div>

                </div>

                <div class="flex justify-between space-x-[8px] text-[20px] font-semibold text-white"><a

                        href="{{ url('/student/form/1') }}"

                        class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#3E3E3E]">Back</a>

                    <div class="flex flex-row space-x-2">

                        <span id="mehedi"

                            class="invisible flex h-0 w-0 cursor-pointer items-center justify-center bg-[#3E3E3E] lg:visible lg:h-[33px] lg:w-[164px]">Save</span>

                        <span onclick="nextStep()"

                            class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#006666]">Save&Continue</span>

                    </div>

                </div>

            </div>

            <script>

                function country() {



                    axios.get('https://restcountries.com/v3.1/all')

                        .then((res) => {

                            const select = document.getElementById("Nationality");

                            res.data.map((item) => {

                                let option = document.createElement("option");

                                option.textContent = item.name.common;

                                option.value = item.name.common;

                                select.appendChild(option);

                            })

                            console.log(res.data);



                        }).catch((err) => {

                            console.log(err);

                        });

                }



                if (!localStorage.getItem('Email')) {

                    localStorage.setItem('Email', '{{ Auth::guard('student')->user()->email }}');

                }



                document.getElementById('PermanentAddress').value = localStorage.getItem('PermanentAddress');

                document.getElementById('CurrentAddress').value = localStorage.getItem('CurrentAddress');

                document.getElementById('PhoneNumber').value = localStorage.getItem('PhoneNumber');

                document.getElementById('GuardianName').value = localStorage.getItem('GuardianName');

                document.getElementById('GuardianCurrentPhoneNumber').value = localStorage.getItem('GuardianCurrentPhoneNumber');

                document.getElementById('PermanentGuardianName').value = localStorage.getItem('PermanentGuardianName');

                document.getElementById('GuardianPermanentPhoneNumber').value = localStorage.getItem(

                'GuardianPermanentPhoneNumber');

                document.getElementById('Nationality').value = 'Select Country';



                document.getElementById('Email').value = localStorage.getItem('Email');



                function nextStep() {

                    if (!localStorage.getItem('PermanentAddress') || !localStorage.getItem('CurrentAddress') || !localStorage

                        .getItem('PhoneNumber') || !localStorage.getItem('Email') || !localStorage.getItem('GuardianName') || !

                        localStorage.getItem('GuardianCurrentPhoneNumber') || !localStorage.getItem('PermanentGuardianName') || !

                        localStorage.getItem('GuardianPermanentPhoneNumber') || !localStorage.getItem('Nationality')) {

                        toastr.options.timeOut = 5000;

                        toastr.error('Please Fill The All Filed');

                    } else {

                        window.location.replace("{{ url('/student/form/3') }}");

                    }

                }



                function handle(name, value) {

                    console.log(name, value);

                    localStorage.setItem(name, value);

                }

            </script>

        </div>

    @endsection

@endif

@if ($id == 3)

    @section('step' . $id)

        <div id="2nd_div" class="w-[100%] space-y-0 lg:relative lg:mt-0 lg:w-[724px] lg:space-y-[19px]">

            <div class="content w-full space-y-[19px]">

                <div class="flex h-[50px] items-center justify-center bg-[#3E3E3E] text-[23px] font-semibold text-white">

                    Student/Admission/<span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>

                </div>

                <div class="space-y-[21px]">

                    <div class="relative">

                        <div class="absolute top-[20px] z-[-1] mx-auto h-1 w-full bg-[#707070]">

                        </div>

                        <div class="flex justify-between text-white">

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">1

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">2

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#006666]">3

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">4

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">5

                            </div>

                        </div>

                    </div>

                    <div class="">

                        <ul class="relative w-full space-y-[15px] overflow-x-auto px-4">

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between">

                                    <span>Religion</span><span>:</span>

                                </li>

                                <select name="Religion" id="Religion" onchange="handle(name,value)"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                                    <option value="Select Religion" disabled selected>Select Religion</option>

                                    <option value="Islam">Islam</option>

                                    <option value="Hindu">Hindu</option>

                                    <option value="Christianity">Christianity</option>

                                    <option value="Buddha">Buddha</option>

                                </select>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between">

                                    <span>Community</span><span>:</span>

                                </li>

                                <input onchange="handle(name,value)" type="text" placeholder="Please Enter"

                                    name="Community" id="Community"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none" />

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between">

                                    <span>Blood Group</span><span>:</span>

                                </li>

                                <select name="BloodGroup" id="BloodGroup" onchange="handle(name,value)"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                                    <option value="Select BloodGroup" disabled selected>Select BloodGroup</option>

                                    <option value="A+">A+</option>

                                    <option value="B+">B+</option>

                                    <option value="O+">O+</option>

                                    <option value="AB+">AB+</option>

                                    <option value="A-">A-</option>

                                    <option value="B-">B-</option>

                                    <option value="O-">O-</option>

                                    <option value="AB-">AB-</option>

                                </select>

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="flex w-[245px] justify-between">

                                    <span>Date of Birth (equivalent SSC certificate)</span><span>:</span>

                                </li>

                                <input onchange="handle(name,value)" type="date" placeholder="Please Enter"

                                    name="DateofBirth" id="DateofBirth"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none" />

                            </div>

                            <div class="flex w-[500px] flex-row justify-around lg:w-full">

                                <li class="relative flex w-[245px] justify-between">

                                    <span>Married Status</span><span>:</span>

                                </li>

                                <select name="MarriedStatus" id="MarriedStatus" onchange="handle(name,value)"

                                    class="w-full border-[1px] border-[#006666] px-[2px] focus:outline-none">

                                    <option value="Select Status" disabled selected>Select Status</option>

                                    <option value="Married">Married</option>

                                    <option value="Unmarried">Unmarried</option>

                                </select>

                            </div>

                        </ul>

                    </div>

                </div>

                <div class="flex justify-between space-x-[8px] text-[20px] font-semibold text-white"><a

                        href="{{ url('/student/form/2') }}"

                        class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#3E3E3E]">Back</a>

                    <div class="relative flex flex-row space-x-2">

                        <span

                            class="absulate left-[500px] flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#3E3E3E]">Save</span>

                        <span onclick="sendData()" id="btn"

                            class="flex h-[33px] w-[164px] cursor-pointer items-center justify-center bg-[#006666]">Submit

                            Data</span>

                        <img src="{{ asset('images/Spinner.gif') }}"

                            class="invisible absolute right-14 -top-5 h-[70px] w-[70px]" id="img" alt="">

                    </div>

                </div>

            </div>

            <script>

                document.getElementById('Religion').value = 'Select Religion';

                document.getElementById('Community').value = localStorage.getItem('Community');

                document.getElementById('BloodGroup').value = 'Select BloodGroup';

                document.getElementById('DateofBirth').value = localStorage.getItem('DateofBirth');

                document.getElementById('MarriedStatus').value = 'Select Status';





                function handle(name, value) {

                    localStorage.setItem(name, value);

                }



                function sendData() {

                    if (!localStorage.getItem('Religion') || !localStorage.getItem('Community') || !localStorage.getItem(

                            'BloodGroup') || !localStorage.getItem('DateofBirth') || !localStorage.getItem('MarriedStatus')) {

                        toastr.options.timeOut = 5000;

                        toastr.error('Please Fill The All Filed');

                    } else {

                        document.getElementById("btn").classList.add("invisible");

                        document.getElementById("img").classList.replace("invisible", "visible");



                        const items = {

                            ...localStorage

                        };

                        axios.post("{{ route('send.data') }}", items)

                            .then((res) => {

                                localStorage.clear();

                                toastr.success(res.data);

                                window.location.replace("{{ url('/student/form/4') }}");

                            }).catch((err) => {

                                toastr.options.timeOut = 10000;

                                toastr.error('Please Fill The All File');

                                document.getElementById("img").classList.replace("visible", "invisible");

                                document.getElementById("btn").classList.replace("invisible", "visible");

                            });

                    }

                }

            </script>



        </div>

    @endsection

@endif

@if ($id == 4)

    @section('step' . $id)

        <div id="2nd_div" class="w-[100%] space-y-0 lg:relative lg:mt-0 lg:w-[724px] lg:space-y-[19px]">

            <div class="content w-full space-y-[19px]">

                <div class="flex h-[50px] items-center justify-center bg-[#3E3E3E] text-[23px] font-semibold text-white">

                    Student/Admission/<span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>

                </div>

                <div class="space-y-[21px]">

                    <div class="relative">

                        <div class="absolute top-[20px] z-[-1] mx-auto h-1 w-full bg-[#707070]">

                        </div>

                        <div class="flex justify-between text-white">

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">1

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">2

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">3

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#006666]">4

                            </div>

                            <div class="flex h-[44px] w-[44px] items-center justify-center rounded-full bg-[#3E3E3E]">5

                            </div>

                        </div>

                    </div>

                    <div class="px-4">

                        <span class="text-xl font-semibold text-[#FF0066]">Congratulations</span>

                        <span class="font-bold uppercase">{{ Auth::guard('student')->user()->fname }}

                            {{ Auth::guard('student')->user()->lname }}</span>

                        <br>

                        <span>Your admission to <span class="uppercase">{{ Auth::guard('student')->user()->dept }}</span>

                            1st

                            Year

                            1st

                            has been received successfully.</span>

                        <br>

                        <span><a href="{{ route('student.pdf') }}" class="text-xl font-semibold text-[#FF0066]" target="_blank">Download

                                pay slips</a> to pay

                            through

                            bank deposit.</span>

                        <br>

                        <span>For final confirmation DOWNLOAD a copy for the future reference.</span>

                        <br>

                        <span>For any assistance, contact the office admin of the

                            {{ Auth::guard('student')->user()->dept }}</span>

                    </div>

                </div>

                <div class="self-center">

                    <a href="{{ route('user.student') }}"

                        class="absolute lg:right-[5%] right-[2%] flex h-[33px] w-[150px] cursor-pointer items-center justify-center bg-[#006666] px-2 text-[16px] text-white hover:bg-[#16afaf]"

                        id="hbtn">Home Page</a>

                </div>

            </div>

        </div>

    @endsection

@endif

