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
    <form action="{{ route('student.certificatePost') }}" method="POST">
        @csrf
        <div class="mt-2 space-y-2 px-[8px] lg:px-0">
            <div id="typeClass">
                <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                    <li class="flex w-full lg:w-[40%] lg:justify-between">
                        <span>Student Type</span><span>:</span>
                    </li>
                    <select name="student_type" id="student_type" class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                        <option value="" selected>select student type</option>
                        <option value="1">Regular</option>
                        <option value="2">Professional</option>
                    </select>
                </div>
                <div class="flex pt-2 flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                    <li class="flex w-full lg:w-[40%] lg:justify-between">
                        <span>Class Name</span><span>:</span>
                    </li>
                    <select name="class_name" id="class_name" class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                        <option value="" selected>select class Name</option>
                        <option value="Under Graduation">Under Graduation</option>
                        <option value="Post Graduation">Post Graduation</option>
                    </select>
                </div>
            </div>
                        <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between">
                    <span>F Program</span><span>:</span>
                </li>
                <select name="fprogram" id="fprogram" class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="#" selected>select program</option>
                    
                </select>
            </div>
            
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Student Full
                        Name</span><span>:</span>
                </li>
                <input type="text" value="{{ $auth->fname }} {{ $auth->lname }}" placeholder="Please Enter"
                    name="full_name" class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Academic Session</span><span>:</span>
                </li>
                <input type="text" value="{{ $auth->session }}" placeholder="Please Enter" name="academic_session"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Student
                        Father Name</span><span>:</span>
                </li>
                <input type="text" value="{{ $auth->FatherName }}" placeholder="Please Enter" name="father_name"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Student
                        Mother Name</span><span>:</span>
                </li>
                <input type="text" value="{{ $auth->MotherName }}" placeholder="Please Enter" name="mother_name"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>District</span><span>:</span>
                </li>
                <select name="district" id="district"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="#" selected>select district</option>
                    @foreach ($districts as $distrct)
                        <option value="{{ $distrct->id }}">{{ $distrct->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Upazila/Thana</span><span>:</span>
                </li>
                <select name="thana" id="thana"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="#" selected>select upazila</option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="relative flex w-full lg:w-[40%] lg:justify-between">
                    <span>Post office</span><span>:</span>
                </li>
                <select name="post_office" id="post_office"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
                    <option value="#" selected>select post office</option>
                </select>
            </div>
            <div class="flex flex-col justify-start lg:flex-row lg:justify-around lg:w-full">
                <li class="flex w-full lg:w-[40%] lg:justify-between"><span>Village/Area
                        Name</span><span>:</span>
                </li>
                <input type="text" name="vill_area" id="vill_area" value="{{ $auth->PermanentAddress }}"
                    placeholder="Enter village/ area name"
                    class="ml-0 lg:w-[60%] lg:ml-[28px] border-2 border-[#006666] px-[2px] focus:outline-none">
            </div>
        </div>
        <div class="my-5 text-center">
            <input type="submit" value="Submit"
                class="cursor-pointer bg-[#006666] px-4 text-[20px] text-white hover:bg-[#0fe3e3]">
        </div>
    </form>


    {{-- <div class="mt-10 sm:mt-0">

        <div class="md:grid md:grid-cols-1">

            <div class="flex justify-start pt-4 pl-4">

                <a href="{{ route('student.certificate') }}"
                    class="w-32 rounded bg-blue-500 py-2 px-4 text-center font-bold text-white hover:bg-blue-700">back</a>

            </div>

            <div class="mt-5 md:col-span-2 md:mt-0">

                <form action="{{ route('student.certificatePost') }}" method="POST">

                    @csrf

                    <div class="shadow sm:rounded-md">

                        <div class="bg-white px-4 py-5 sm:p-6">

                            <div class="grid grid-cols-1">

                                <div class="col-span-2 sm:col-span-3">

                                    <label for="fprogram" class="block text-sm font-medium text-gray-700">F Program</label>

                                    <select name="fprogram" id="fprogram"
                                        class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                        <option value="#" selected>select program</option>

                                        @foreach ($degree as $dg)
                                            <option value="{{ $dg->id }}">{{ $dg->degree_name }}</option>
                                        @endforeach



                                    </select>

                                </div>

                                <div class="col-span-2 flex py-4 sm:col-span-3">

                                    <div class="col-span-2 w-1/2 sm:col-span-3">

                                        <label for="full_name" class="block text-sm font-medium text-gray-700">Student Full
                                            Name</label>

                                        <input type="text" name="full_name" id="full_name"
                                            placeholder="Enter student full name"
                                            value="{{ $auth->fname }} {{ $auth->lname }}"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                    </div>

                                    <div class="col-span-2 w-1/2 pl-2 sm:col-span-3">

                                        <label for="academic_session"
                                            class="block text-sm font-medium text-gray-700">Academic Session</label>

                                        <input type="text" name="academic_session" id="academic_session"
                                            value="{{ $auth->session }}" placeholder="Enter Academic Session"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                    </div>

                                </div>



                                <div class="col-span-2 flex py-4 sm:col-span-3">

                                    <div class="col-span-2 w-1/2 sm:col-span-3">

                                        <label for="father_name" class="block text-sm font-medium text-gray-700">Student
                                            Father Name</label>

                                        <input type="text" name="father_name" id="father_name"
                                            value="{{ $auth->FatherName }}" placeholder="Enter student father name"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                    </div>

                                    <div class="col-span-2 w-1/2 pl-2 sm:col-span-3">

                                        <label for="mother_name" class="block text-sm font-medium text-gray-700">Student
                                            Mother Name</label>

                                        <input type="text" name="mother_name" id="mother_name"
                                            value="{{ $auth->MotherName }}" placeholder="Enter student mother name"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                    </div>

                                </div>

                                <div class="col-span-2 flex py-4 sm:col-span-3">

                                    <div class="col-span-2 w-1/3 sm:col-span-3">

                                        <label for="district"
                                            class="block text-sm font-medium text-gray-700">District</label>

                                        <select name="district" id="district"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                            <option value="#" selected>select district</option>

                                            @foreach ($districts as $distrct)
                                                <option value="{{ $distrct->id }}">{{ $distrct->name }}</option>
                                            @endforeach



                                        </select>

                                    </div>

                                    <div class="col-span-2 w-1/3 px-2 sm:col-span-3">

                                        <label for="thana" class="block text-sm font-medium text-gray-700">Upazila/
                                            Thana</label>

                                        <select name="thana" id="thana"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                            <option value="#" selected>select upazila</option>

                                        </select>

                                    </div>

                                    <div class="col-span-2 w-1/3 sm:col-span-3">

                                        <label for="post_office" class="block text-sm font-medium text-gray-700">Post
                                            office</label>

                                        <select name="post_office" id="post_office"
                                            class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                            <option value="#" selected>select post office</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-span-2 sm:col-span-3">

                                    <label for="vill_area" class="block text-sm font-medium text-gray-700">Village/Area
                                        Name</label>

                                    <input type="text" name="vill_area" id="vill_area"
                                        value="{{ $auth->PermanentAddress }}" placeholder="Enter village/ area name"
                                        class="mt-1 block h-10 w-full rounded-md border-2 border-gray-300 pl-3 text-base shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                                </div>







                            </div>



                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">

                            <button type="submit"
                                class="inline-flex w-3/6 justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div> --}}
@endsection

@section('scriptDevDept')
    <script>
        $('#typeClass').on('change',()=>{
            var student_type = $('#student_type').val();
            var class_name = $('#class_name').val();
            if( student_type && class_name ){
                $.ajax({
                    type:'GET',
                    url:'/student-get-program-'+class_name,
                    success:(response)=>{
                        $('#fprogram').text('')
                        var data_add = '<option value="">selected program</option>';
                        $('#fprogram').append(data_add);
                        response.forEach((res)=>{
                            if(res['special_degree'] !='null' && student_type=='2' ){
                                var data_add = '<option value="'+res['id']+'">'+res['special_degree'] +'</option>';
                                $('#fprogram').append(data_add);
                            }
                            if(res['degree_name'] !='null' && student_type=='1'){
                                var data_add = '<option value="'+res['id']+'">'+res['degree_name'] +'</option>';
                                $('#fprogram').append(data_add);
                            }
                        });
                    }
                });
            }
        });
        $("#district").on('change', () => {

            var district_id = $('#district').val();

            $.ajax({

                method: 'GET',

                url: "/upazila/search/" + district_id,

                success: (response) => {

                    $('#thana').html(response);

                }

            });

        });

        $('#thana').on('change', () => {

            var upazila_id = $("#thana").val();

            $.ajax({

                method: "GET",

                url: "/post-office/list/" + upazila_id,

                success: (response) => {

                    $('#post_office').html(response);

                }

            });

        })
    </script>
@endsection
