@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Take Leave Application</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div style="display: flex;justify-content: end;">
            <a href="{{route('teacher.takeLeaveApplicationCreateView')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Take leave application</a>
        </div>
        <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 ">Reason For Leave</th>
                        <th class="border border-slate-300 ">vacation start</th>
                        <th class="border border-slate-300 ">vacation days</th>
                        <th class="border border-slate-300 ">Approve days</th>
                        <th class="border border-slate-300 ">Approve status</th>
                        <th class="border border-slate-300 ">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inprocess as $application)
                        <tr>
                            <td class="border border-slate-300 text-center capitalize">{{$application->reason_title}}</td>
                            <td class="border border-slate-300 text-center">{{$application->vacation_start}}</td>
                            <td class="border border-slate-300 text-center">{{$application->vacation_days}}</td>
                            <td class="border border-slate-300 text-center">
                                @if($application->approve_days > 0) 
                                {{$application->approve_days}} 
                                @else 0 
                                @endif 
                            </td>
                            <td class="border border-slate-300 text-center">
                                In Process</td>
                            <td class="border border-slate-300 text-center">
                                <a href="{{route('teacher.takeLeaveApplicationDetails',['application_id'=>$application->id])}}">Details</a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($approve as $application)
                        <tr>
                            <td class="border border-slate-300 text-center capitalize">{{$application->reason_title}}</td>
                            <td class="border border-slate-300 text-center">{{$application->vacation_start}}</td>
                            <td class="border border-slate-300 text-center">{{$application->vacation_days}} </td>
                            <td class="border border-slate-300 text-center">{{$application->approve_days}}</td>
                            <td class="border border-slate-300 text-center">Approve</td>
                            <td class="border border-slate-300 text-center">
                                <a href="{{route('teacher.takeLeaveApplicationDetails',['application_id'=>$application->id])}}">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        

    </div>
</div>
@endsection
@section('scriptDevDept')

    
@endsection