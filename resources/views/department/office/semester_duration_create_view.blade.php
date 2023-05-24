@extends('layouts.Dashboard')
@section('content')

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-1 ">
    <div class="pt-4 pl-4 flex justify-start" >
        <a href="{{route('office.semesterDurationList')}}" class="w-32 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">back</a>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="{{route('office.semesterDurationCreate')}}" method="POST">
        @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <div class="col-span-2 sm:col-span-3 ">
                          <label for="year" class="block text-sm font-medium text-gray-700">Semester Year</label>
                          <select name="year" id="semester_year" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="" >select year</option>
                            <option value="2022" >2022</option>
                          </select>
                      
                    </div>
                    <div class="col-span-2 sm:col-span-3 ">
                          <label for="semester_start" class="block text-sm font-medium text-gray-700">Semester Start Date</label>
                          <input type="date"  id="semester_start" name="semester_start" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                          <label for="semester_end" class="block text-sm font-medium text-gray-700">Semester End Date</label>
                          <input type="date" id="semester_end" name="semester_end"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                </div>
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
    var minYear = new Date().getFullYear();
    for(var j = minYear;j <= minYear+12;j++){
        var createYear = '<option value="'+j+'">'+j+'</option>';
        $('#semester_year').append(createYear);
    }
    
</script>
@endsection