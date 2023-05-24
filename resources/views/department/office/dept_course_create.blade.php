@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div class="pt-4 pl-4 flex justify-start" >
            <a href="{{route('dept_course')}}" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="{{route('courseCreateSave')}}" method="POST">
                @csrf
                <div class=" shadow sm:rounded-md">
                    <div class="bg-white px-4 py-5 sm:p-6">
                            <div id="getProgram">
                                <div class="col-span-2 sm:col-span-3">
                                    <label for="student_type" class="block text-sm font-medium text-gray-700">Student Type</label>
                                    <select  name="student_type" id="student_type" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                        <option value="" @if(optional(session('course_student_type'))->value == '') {{ 'selected'}} @endif>select program</option>
                                        <option value="1" @if(optional(session('course_student_type'))->value == '1') {{ 'selected'}} @endif>Regular</option>
                                        <option value="2" @if(optional(session('course_student_type'))->value == '2') {{ 'selected'}} @endif>Professional</option>
                                        <!--<option value="Special">Special</option>-->
                                    </select>   
                                </div>
                                <div class="col-span-2 sm:col-span-3">
                                    <label for="batch_session" class="block text-sm font-medium text-gray-700">Session</label>
                                    <select  name="batch_session" id="batch_session" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                        <option value="" selected>select session</option>
                                        
                                    </select>   
                                </div>
                                <div class="col-span-2 sm:col-span-3">
                                    <label for="class_name" class="block text-sm font-medium text-gray-700">Class Name</label>
                                    <select  name="class_name" id="class_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                        <option value="" selected>select class</option>
                                        <option value="Under Graduation">Under Graduation</option>
                                        <option value="Post Graduation">Post Graduation</option>
                                    </select>   
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-3 ">
                                <label for="program_name" class="block text-sm font-medium text-gray-700">Program Name</label>
                                <select  name="program_name" id="program_name" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                    <option value="" selected>select program</option>

                                </select>
                            
                            </div>
                            <div class="col-span-2 sm:col-span-3 hidden" id="post">
                                <label for="semester" class="block text-sm font-medium text-gray-700">Year/Semester</label>
                                <select  name="semester" id="semesterp" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                    <option value="" disabled selected>Select semester</option>
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
                            <div class="col-span-2 sm:col-span-3 " id="under">
                                <label for="semester" class="block text-sm font-medium text-gray-700">Year/Semester</label>
                                <select  name="semester" id="semesteru" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                    <option value="" disabled selected>Select semester</option>
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
                            <div class="col-span-2 sm:col-span-3 hidden" id="postSemester4Major">
                                <label for="majorcourse" class="block text-sm font-medium text-gray-700">Major</label>
                                <select  name="majorcourse" id="majorcourse" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                    <option value="" disabled selected>Select major</option>
                                    <option value="HRM">HRM</option>
                                    <option value="AIS">AIS</option>
                                    <option value="MKT">MKT</option>
                                    <option value="FNB">FNB</option>
                                    <option value="THM">THM</option>
                                </select>
                            
                            </div>
                            
                            <div class="col-span-2 sm:col-span-3 ">
                                <label for="course_code" class="block text-sm font-medium text-gray-700">Course Code</label>
                                <input type="text" name="course_code" id="course_code" value="{{old('course_code')}}" placeholder="course code" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            </div>
                            <div class="col-span-2 sm:col-span-3 ">
                                <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                                <input type="text" name="course_name" id="course_name" placeholder="course name" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            </div>
                            <div class="col-span-2 sm:col-span-3 ">
                                <label for="course_credit" class="block text-sm font-medium text-gray-700">Credit</label>
                                <input type="number" step='any' name="course_credit" id="course_credit" placeholder="Enter course credit" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            </div>
                            <div class="col-span-2 sm:col-span-3 ">
                                <label for="contact_hours" class="block text-sm font-medium text-gray-700">Contact hours/weak</label>
                                <input type="number" name="contact_hours" id="contact_hours" placeholder="Enter contact hours/weak" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            </div>
                        
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" id="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@section('scriptDevDept')
<script>
    var student_type_s = sessionStorage.getItem('course_student_type');
    var batch_session_s = sessionStorage.getItem('course_batch_session');
    var class_name_s = sessionStorage.getItem('course_class_name');
    var program_name_s = sessionStorage.getItem('course_program_name');
    console.log(student_type_s)
    $('#student_type').on('change',()=>{
        var program = $('#student_type').val();
        $.ajax({
            method:"GET",
            url:'/program-type-session-'+program,
            success:(response)=>{
                $('#batch_session').html(response);
                // console.log(response);
            }
        })
    });
    $("#class_name").on('change',()=>{
        var class_name = $('#class_name').val();
        $.ajax({
            method:"GET",
            url:'/class-name-to-program-'+class_name,
            success:(response)=>{
                $('#program_name').html(response);
            }
        })
        if(class_name == 'Under Graduation'){
            $('#under').removeClass('hidden');
            $('#post').addClass('hidden');
        }else{
            $('#post').removeClass('hidden');
            $('#under').addClass('hidden');
        }
    })
    $('#semesterp').on('change',()=>{
        $semester = $('#semesterp').val();
        if($semester =='4th Semester'){
            $("#postSemester4Major").removeClass('hidden');
        }else{
            $("#postSemester4Major").addClass('hidden');
            $('#majorcourse').val('');
        }
    })
    
    $('#submit').on('click',()=>{
        var student_type = $('#student_type').val();
        var batch_session =$('#batch_session').val();
        var class_name = $('#class_name').val();
        var program_name = $('#program_name').val();
        sessionStorage.setItem('course_student_type',student_type);
        sessionStorage.setItem('course_batch_session',batch_session);
        sessionStorage.setItem('course_class_name',class_name);
        sessionStorage.setItem('course_program_name',program_name);
        
    })
    
</script>
@endsection
