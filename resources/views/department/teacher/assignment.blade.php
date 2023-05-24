@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Student Attendance</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
    <form action="{{route('teacher.courseAssignmentCreate')}}" method="POST">
        @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <input type="text" name="course_id"  value="{{$course_id}}" hidden>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="assignment_title" class="block text-sm font-medium text-gray-700">Assignment Title</label>
                        <input type="text" name="assignment_title" id="assignment_title" placeholder="Enter Assignment title" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    <div class="col-span-2 my-2 sm:col-span-3">
                        <label for="assignment_description" class="block text-sm font-medium text-gray-700">Assignment Description</label>
                        <textarea name="assignment_description" placeholder="Enter assignment description" class="border-2 pl-3 h-[30vh] mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"></textarea>
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                          <label for="submit_last_date" class="block text-sm font-medium text-gray-700">Submition Deadline</label>
                          <input type="date"  id="submit_last_date" name="submit_last_date" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="w-3/6 inline-flex justify-center rounded-md border border-transparent bg-[#1AA2A2] py-1 px-4 text-lg font-medium text-white shadow-sm hover:bg-[#006666] focus:outline-none focus:ring-2 focus:ring-[#006666]-500 focus:ring-offset-2">Save</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
@section('scriptDevDept')

    
@endsection