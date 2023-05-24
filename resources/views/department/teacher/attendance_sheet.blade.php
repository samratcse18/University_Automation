

@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Couese Code : {{$course->course_code}}</h1>
<h1>{{$course->semester}}</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4">
            
            <div class="flex justify-center">
                <div class="grid grid-cols-2">
                    <div>
                        <table class="table-fixed w-full">
                            <thead>
                                <tr class="h-[85px] border-t-[1px] border-l-[1px]">
                                    <th></th>
                                </tr>
                                @foreach($student_ids as $student)
                                    <tr class="border-t-[1px] border-l-[1px]">
                                        <th class="text-center">{{$student->student_id}}</th>
                                    </tr>
                                @endforeach
                                
                            </thead>
                            
                        </table>
                    </div>
                    <div>
                        <table class="table-fixed">
                            <thead>
                                <tr class="h-[85px] border-t-[1px] border-r-[1px]">
                                    @foreach($class_dates as $cls_date)
                                    <th class="text-[11px]" style="transform: rotate(-86deg);white-space: nowrap">{{$cls_date->create_at}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance_sheet as $date)
                                    <tr class="border-t-[1px] border-r-[1px]">
                                        @foreach($date as $attendance)
                                            @if($attendance->attendance_status == 1)
                                            <td class="text-center">p</td>
                                            @else
                                            <td class="text-center">a</td>
                                            @endif
                                            
                                        @endforeach
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
@section('scriptDevDept')

    
@endsection