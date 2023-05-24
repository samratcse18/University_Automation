@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Department Teacher Take Leave Application</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        
        <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 ">Name</th>
                        <th class="border border-slate-300 ">Reason For Leave</th>
                        <th class="border border-slate-300 ">status</th>
                        <th class="border border-slate-300 ">Acations</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($applications as $vacation)
                    <tr>
                        <td class="border border-slate-300 text-center">{{$vacation->first_name}} {{$vacation->last_name}}</td>
                        <td class="border border-slate-300 text-center">{{$vacation->reason}}</td>
                        <td class="border border-slate-300 text-center">
                            @if($vacation->status == 0)
                                In Procsess
                            @else
                                Approve
                            @endif
                        </td>
                        <td class="border border-slate-300 text-center">
                            <a href="{{route('teacher.takeLeaveApplicationDetails',['application_id'=>$vacation->vacation_id])}}">Details</a>
                            <a href="{{route('chairman.chairmanApproveLeaveApplicationView',['application_id'=>$vacation->vacation_id])}}">Approve days</a>
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