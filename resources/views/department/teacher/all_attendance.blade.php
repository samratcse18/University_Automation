@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Student Attendance</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4">
            
            @if($routine_info)
                @foreach($routine_info as $info)
                    <a href="{{route('studentAttendanceSheet',['course_id'=>$info->course_id])}}" class="bg-[green] text-[#ffffff] text-[2rem] text-center py-4 rounded hover:bg-inherit border border-teal-800 hover:text-[green]">{{$info->course_code}}</a>
                @endforeach
            @endif
        </div>

    </div>
</div>
@endsection
@section('scriptDevDept')

    
@endsection