@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Department Teacher Take Leave Application Approve</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
    <form action="{{route('chairman.leaveApplicationApprove')}}" method="POST">
        @csrf
        <div class=" shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1">
                    <input type="text" name="application_id" value="{{$application->id}}" hidden>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="reasonForLeave" class="block text-sm font-medium text-gray-700">Reason For Leave</label>
                        <input type="text" name="reasonForLeave" id="reasonForLeave" value="{{$application->reason_title}}" disabled class="capitalize border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="vacation_start_date" class="block text-sm font-medium text-gray-700">Vacation Start Date</label>
                        <input type="text" name="vacation_start_date" id="vacation_start_date" value="{{$application->vacation_start}}" disabled class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="vacation_end_date" class="block text-sm font-medium text-gray-700">Vacation End Date</label>
                        <input type="text" name="vacation_end_date" id="vacation_end_date" value="{{$application->vacation_end}}" disabled class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="request_vacation_days" class="block text-sm font-medium text-gray-700">Request Vacation Days</label>
                        <input type="text" id="request_vacation_days" name="request_vacation_days" value="{{$application->vacation_days}}" disabled  class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    <div class="col-span-2 sm:col-span-3">
                        <label for="approve_days" class="block text-sm font-medium text-gray-700">Approve Vacation Days</label>
                        <input type="text" id="approve_days" name="approve_days" placeholder="Enter Approve vacation days" class="border-2 pl-3 h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
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
   
    
    
</script>
    
@endsection