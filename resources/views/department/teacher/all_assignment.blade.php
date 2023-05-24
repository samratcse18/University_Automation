@extends('layouts.Dashboard')
@section('divHeadTitle')
<h1>Student Attendance</h1>
@endsection
@section('content')
<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 ">
        
        <table class="border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 ">Course Code</th>
                        <th class="border border-slate-300 ">Assignment title</th>
                        <th class="border border-slate-300 ">Submit Last Date </th>
                        <th class="border border-slate-300 ">Submit File </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment )
                    <tr>
                        <td class="border border-slate-300 text-center">{{$assignment->course_code}}</td>
                        <td class="border border-slate-300 text-center">{{$assignment->assignment_title}}</td>
                        <td class="border border-slate-300 text-center">{{$assignment->submit_last_date}}</td>
                        <td class="border border-slate-300 text-center">
                            <a href="#">Files</a>
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