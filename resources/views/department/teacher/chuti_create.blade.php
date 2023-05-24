@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Student Attendance</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
    <form action="{{route('teacher.takeLeaveApplicationCreate')}}" method="POST">
        @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <div class="col-span-2 sm:col-span-3">
                        <label for="reason_for_leave" class="block text-sm font-medium text-gray-700">Reason For Leave</label>
                        <select  name="reason_for_leave" id="reason_for_leave" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                          <option value="#" selected>select reason name</option>
                          <option value="casual">Casual</option>
                          <option value="medical">Medical</option>
                          <option value="duty">Duty</option>
                          <option value="others">Others</option>
                        </select>
                    
                    </div>
                    <div class=" py-4 flex col-span-2 sm:col-span-3" style="display:flex">
                      <div class="col-span-2 sm:col-span-3 w-1/2">
                          <label for="vacation_start" class="block text-sm font-medium text-gray-700">Vacation Start Date</label>
                          <input type="date"  id="vacation_start" name="vacation_start" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                      
                      </div>
                      <div class="col-span-2 sm:col-span-3 w-1/2 pl-2">
                          <label for="vacation_end" class="block text-sm font-medium text-gray-700">Vacation End Date</label>
                          <input type="date" id="vacation_end" name="vacation_end"  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <input type="text" id="vacation_days" name="vacation_days" hidden>
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="helper_id" class="block text-sm font-medium text-gray-700">Helper man</label>
                        <select  name="helper_id" id="helper_id" class="border-2 pl-3  h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="#" selected>select metting name</option>
                            @if(count($dept_teacher) >0)
                                @foreach($dept_teacher as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->email}}</option>
                                @endforeach
                            @endif
                        </select>
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
@endsection
@section('scriptDevDept')
<script>
   
    $('#vacation_start').on('change',()=>{
        var start_date = $('#vacation_start').val();
        var end_date = $('#vacation_end').val();
        if(start_date && end_date){
            var start = moment(start_date);
            var end = moment(end_date);
            var days = end.diff(start,'days');
            $('#vacation_days').val(days);

        }
    });
    $('#vacation_end').on('change',()=>{
        var start_date = $('#vacation_start').val();
        var end_date = $('#vacation_end').val();
        if(start_date && end_date){
            var start = moment(start_date);
            var end = moment(end_date);
            var days = end.diff(start,'days');
            $('#vacation_days').val(days);

        }
    });
    
</script>
    
@endsection