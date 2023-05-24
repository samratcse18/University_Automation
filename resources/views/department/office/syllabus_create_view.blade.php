@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div class="pt-4 pl-4 flex justify-start" >
            <a href="{{route('dept_course')}}" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="{{route('dept.syllabusAdd')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class=" shadow sm:rounded-md">
                     <div id="getProgram">
                        <div class="col-span-2 sm:col-span-3">
                            <label for="student_type" class="block text-sm font-medium text-gray-700">Student Type</label>
                            <select  name="student_type" id="student_type" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                                <option value="" @if(old('student_type') == '') {{ 'selected'}} @endif>select program</option>
                                <option value="1" @if(old('student_type') == '1') {{ 'selected'}} @endif>Regular</option>
                                <option value="2" @if(old('student_type') == '2') {{ 'selected'}} @endif>Professional</option>
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
                    
                    <div class="col-span-2 sm:col-span-3 ">
                        <label for="syllabus_file" class="block text-sm font-medium text-gray-700">Session Syllabus</label>
                        <input type="file" name="syllabus_file" id="syllabus_file" placeholder="session syllabus" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@section('scriptDevDept')
<script>
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
        });
        
    });
</script>
@endsection